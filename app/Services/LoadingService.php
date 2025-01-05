<?php

namespace App\Services;

use App\Models\LoadingInfo;
use App\Models\Order;
use App\Models\Run;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class LoadingService
{
    public function getLoadingStatus(string $type, string $id): LoadingInfo
    {
        return LoadingInfo::where('loadable_type', $this->getLoadableType($type))
            ->where('loadable_id', $id)
            ->firstOrFail();
    }

    public function updateLoadingStatus(
        string $type,
        string $id,
        ?string $status,
        ?array $itemsLoadingStatus
    ): LoadingInfo {
        $loading = $this->findOrCreateLoadingInfo($type, $id);

        if ($status !== null) {
            $loading->status = $status;
        }
        if ($itemsLoadingStatus !== null) {
            $loading->items_loading_status = $itemsLoadingStatus;
        }

        $loading->save();
        return $loading;
    }

    public function startLoading(string $type, string $id): LoadingInfo
    {
        $loading = $this->findOrCreateLoadingInfo($type, $id);

        $loading->status = 'IN_PROGRESS';
        $loading->loading_started_at = now();
        $loading->save();

        return $loading;
    }

    public function completeLoading(string $type, string $id): LoadingInfo
    {
        $loading = $this->findOrCreateLoadingInfo($type, $id);

        $loading->status = 'COMPLETED';
        $loading->loading_completed_at = now();
        $loading->save();

        return $loading;
    }

    public function getLoadingHistory(string $type, string $id): array
    {
        $loading = $this->getLoadingStatus($type, $id);
        return [
            'status_history' => $loading->items_loading_status ?? [],
            'started_at' => $loading->loading_started_at,
            'completed_at' => $loading->loading_completed_at,
        ];
    }

    private function findOrCreateLoadingInfo(string $type, string $id): LoadingInfo
    {
        $loadableType = $this->getLoadableType($type);
        $this->validateLoadableExists($loadableType, $id);

        return LoadingInfo::firstOrNew([
            'loadable_type' => $loadableType,
            'loadable_id' => $id,
        ]);
    }

    private function getLoadableType(string $type): string
    {
        return match (strtolower($type)) {
            'order' => Order::class,
            'run' => Run::class,
            default => throw new \InvalidArgumentException("Invalid loadable type: {$type}")
        };
    }

    private function validateLoadableExists(string $loadableType, string $id): void
    {
        if (!$loadableType::find($id)) {
            throw new ModelNotFoundException("$loadableType with ID $id not found");
        }
    }
}
