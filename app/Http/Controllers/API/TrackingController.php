<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TrackingService;
use App\Http\Resources\TrackingInfoResource;
use App\Http\Requests\UpdateTrackingRequest;
use Illuminate\Http\JsonResponse;

final class TrackingController extends Controller
{
    public function __construct(
        private readonly TrackingService $trackingService
    ) {}

    public function getOrderTracking(string $orderId): JsonResponse
    {
        $tracking = $this->trackingService->getOrderTracking($orderId);
        return response()->json(new TrackingInfoResource($tracking));
    }

    public function updateOrderTracking(UpdateTrackingRequest $request, string $orderId): JsonResponse
    {
        $tracking = $this->trackingService->updateOrderTracking(
            $orderId,
            $request->input('latitude'),
            $request->input('longitude'),
            $request->input('status')
        );
        return response()->json(new TrackingInfoResource($tracking));
    }

    public function getVehicleTracking(string $vehicleId): JsonResponse
    {
        $tracking = $this->trackingService->getVehicleTracking($vehicleId);
        return response()->json(new TrackingInfoResource($tracking));
    }

    public function updateVehicleTracking(UpdateTrackingRequest $request, string $vehicleId): JsonResponse
    {
        $tracking = $this->trackingService->updateVehicleTracking(
            $vehicleId,
            $request->validated()
        );
        return response()->json(new TrackingInfoResource($tracking));
    }

    public function getVehicleTrackingHistory(string $vehicleId): JsonResponse
    {
        $history = $this->trackingService->getVehicleTrackingHistory($vehicleId);
        return response()->json(['tracking_history' => $history]);
    }

    public function getOrderTrackingHistory(string $orderId): JsonResponse
    {
        $history = $this->trackingService->getOrderTrackingHistory($orderId);
        return response()->json(['tracking_history' => $history]);
    }
}
