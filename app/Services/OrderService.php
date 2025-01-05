<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class OrderService
{
    public function listOrders(
        ?string $territoryId = null,
        ?string $status = null,
        ?string $dateFrom = null,
        ?string $dateTo = null
    ): Collection {
        $query = Order::query();

        if ($territoryId) {
            $query->where('territory_id', $territoryId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($dateFrom) {
            $query->where('delivery_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('delivery_date', '<=', $dateTo);
        }

        return $query->get();
    }

    public function createOrder(array $data): Order
    {
        return Order::create($data);
    }

    public function getOrder(string $id): Order
    {
        return Order::findOrFail($id);
    }

    public function updateOrder(string $id, array $data): Order
    {
        $order = $this->getOrder($id);
        $order->update($data);
        return $order;
    }

    public function deleteOrder(string $id): void
    {
        $order = $this->getOrder($id);
        $order->delete();
    }

    public function getExecutionDetails(string $id): array
    {
        $order = $this->getOrder($id);
        return [
            'execution_status' => $order->execution_status,
            'execution_history' => $order->execution_history,
            'assigned_driver' => $order->driver,
            'assigned_vehicle' => $order->vehicle,
            'estimated_arrival' => $order->estimated_arrival,
            'actual_arrival' => $order->actual_arrival,
            'completion_time' => $order->completion_time,
        ];
    }

    public function getOrderItems(string $id): array
    {
        $order = $this->getOrder($id);
        return $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'notes' => $item->notes,
            ];
        })->toArray();
    }

    public function getPodDetails(string $id): array
    {
        $order = $this->getOrder($id);
        return [
            'signature' => $order->pod_signature,
            'signature_timestamp' => $order->pod_signature_timestamp,
            'signed_by' => $order->pod_signed_by,
            'photos' => $order->pod_photos,
            'notes' => $order->pod_notes,
        ];
    }

    public function getWidgetInfo(string $id): array
    {
        $order = $this->getOrder($id);
        return [
            'status' => $order->status,
            'tracking_info' => $order->trackingInfo,
            'loading_info' => $order->loadingInfo,
            'execution_status' => $order->execution_status,
            'estimated_arrival' => $order->estimated_arrival,
        ];
    }
}
