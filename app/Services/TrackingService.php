<?php

namespace App\Services;

use App\Models\TrackingInfo;
use App\Models\VehicleTracking;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class TrackingService
{
    public function getOrderTracking(string $orderId): TrackingInfo
    {
        return TrackingInfo::where('order_id', $orderId)
            ->firstOrFail();
    }

    public function updateOrderTracking(
        string $orderId,
        ?float $latitude,
        ?float $longitude,
        ?string $status
    ): TrackingInfo {
        $tracking = TrackingInfo::firstOrNew(['order_id' => $orderId]);

        if ($latitude !== null) {
            $tracking->current_latitude = $latitude;
        }
        if ($longitude !== null) {
            $tracking->current_longitude = $longitude;
        }
        if ($status !== null) {
            $tracking->status = $status;
        }

        // Update tracking history
        $history = $tracking->tracking_history ?? [];
        $history[] = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'status' => $status,
            'timestamp' => now()->toIso8601String()
        ];
        $tracking->tracking_history = $history;

        $tracking->save();
        return $tracking;
    }

    public function getVehicleTracking(string $vehicleId): VehicleTracking
    {
        return VehicleTracking::where('vehicle_id', $vehicleId)
            ->firstOrFail();
    }

    public function updateVehicleTracking(string $vehicleId, array $data): VehicleTracking
    {
        $tracking = VehicleTracking::firstOrNew(['vehicle_id' => $vehicleId]);

        $tracking->fill(array_filter($data));
        $tracking->last_update = now();

        // Update tracking data history
        $trackingData = $tracking->tracking_data ?? [];
        $trackingData[] = array_merge($data, ['timestamp' => now()->toIso8601String()]);
        $tracking->tracking_data = $trackingData;

        $tracking->save();
        return $tracking;
    }

    public function getVehicleTrackingHistory(string $vehicleId): array
    {
        $tracking = $this->getVehicleTracking($vehicleId);
        return $tracking->tracking_data ?? [];
    }

    public function getOrderTrackingHistory(string $orderId): array
    {
        $tracking = $this->getOrderTracking($orderId);
        return $tracking->tracking_history ?? [];
    }
}
