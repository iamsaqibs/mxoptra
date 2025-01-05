<?php

namespace App\Services;

use App\Models\Run;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class RunService
{
    public function listRuns(
        ?string $territoryId = null,
        ?string $status = null,
        ?string $dateFrom = null,
        ?string $dateTo = null
    ): Collection {
        $query = Run::query();

        if ($territoryId) {
            $query->where('territory_id', $territoryId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($dateFrom) {
            $query->where('start_time', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('end_time', '<=', $dateTo);
        }

        return $query->get();
    }

    public function createRun(array $data): Run
    {
        return Run::create($data);
    }

    public function getRun(string $id): Run
    {
        return Run::findOrFail($id);
    }

    public function updateRun(string $id, array $data): Run
    {
        $run = $this->getRun($id);
        $run->update($data);
        return $run;
    }

    public function deleteRun(string $id): void
    {
        $run = $this->getRun($id);
        $run->delete();
    }

    public function getRunSchedule(string $id, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $run = $this->getRun($id);
        $query = $run->orders();

        if ($dateFrom) {
            $query->where('delivery_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('delivery_date', '<=', $dateTo);
        }

        $orders = $query->get();

        return [
            'run' => [
                'id' => $run->id,
                'status' => $run->status,
                'start_time' => $run->start_time,
                'end_time' => $run->end_time,
                'driver' => $run->driver,
                'vehicle' => $run->vehicle,
            ],
            'orders' => $orders->map(function ($order) {
                return [
                    'order_id' => $order->id,
                    'status' => $order->status,
                    'delivery_time' => $order->delivery_time,
                    'sequence' => $order->pivot->sequence,
                ];
            }),
        ];
    }

    public function getRunOrders(string $id): Collection
    {
        $run = $this->getRun($id);
        return $run->orders()->orderBy('sequence')->get();
    }

    public function addOrderToRun(string $id, string $orderId): Run
    {
        $run = $this->getRun($id);
        $order = Order::findOrFail($orderId);

        if (!$run->orders->contains($orderId)) {
            $sequence = $run->orders->max('pivot.sequence') ?? 0;
            $run->orders()->attach($orderId, ['sequence' => $sequence + 1]);
            $run->load('orders');
        }

        return $run;
    }

    public function removeOrderFromRun(string $id, string $orderId): Run
    {
        $run = $this->getRun($id);
        $run->orders()->detach($orderId);
        $run->load('orders');
        return $run;
    }
}
