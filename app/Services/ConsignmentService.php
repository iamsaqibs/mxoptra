<?php

namespace App\Services;

use App\Models\Consignment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ConsignmentService
{
    public function getConsignment(string $referenceNumber): Consignment
    {
        return Consignment::where('reference_number', $referenceNumber)
            ->firstOrFail();
    }

    public function createConsignment(
        string $pickupOrderId,
        string $deliveryOrderId,
        string $referenceNumber,
        array $metadata = []
    ): Consignment {
        // Validate orders exist
        $this->validateOrderExists($pickupOrderId);
        $this->validateOrderExists($deliveryOrderId);

        // Validate reference number is unique
        if (Consignment::where('reference_number', $referenceNumber)->exists()) {
            throw new \InvalidArgumentException("Consignment with reference number {$referenceNumber} already exists");
        }

        return Consignment::create([
            'pickup_order_id' => $pickupOrderId,
            'delivery_order_id' => $deliveryOrderId,
            'reference_number' => $referenceNumber,
            'status' => 'CREATED',
            'metadata' => $metadata,
        ]);
    }

    public function updateStatus(string $referenceNumber, string $status): Consignment
    {
        $consignment = $this->getConsignment($referenceNumber);

        // Add status change to metadata history
        $metadata = $consignment->metadata ?? [];
        $metadata['status_history'][] = [
            'status' => $status,
            'previous_status' => $consignment->status,
            'timestamp' => now()->toIso8601String()
        ];

        $consignment->status = $status;
        $consignment->metadata = $metadata;
        $consignment->save();

        return $consignment;
    }

    public function getConsignmentsByOrder(string $orderId): Collection
    {
        return Consignment::where('pickup_order_id', $orderId)
            ->orWhere('delivery_order_id', $orderId)
            ->get();
    }

    public function getConsignmentHistory(string $referenceNumber): array
    {
        $consignment = $this->getConsignment($referenceNumber);
        return $consignment->metadata['status_history'] ?? [];
    }

    private function validateOrderExists(string $orderId): void
    {
        if (!Order::find($orderId)) {
            throw new ModelNotFoundException("Order with ID {$orderId} not found");
        }
    }
}
