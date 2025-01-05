<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\VehicleService;
use App\Http\Resources\VehicleResource;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class VehicleController extends Controller
{
    public function __construct(
        private readonly VehicleService $vehicleService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $vehicles = $this->vehicleService->listVehicles(
            $request->query('territory_id'),
            $request->query('status'),
            $request->query('type')
        );
        return response()->json(VehicleResource::collection($vehicles));
    }

    public function store(CreateVehicleRequest $request): JsonResponse
    {
        $vehicle = $this->vehicleService->createVehicle($request->validated());
        return response()->json(new VehicleResource($vehicle), 201);
    }

    public function show(string $id): JsonResponse
    {
        $vehicle = $this->vehicleService->getVehicle($id);
        return response()->json(new VehicleResource($vehicle));
    }

    public function update(UpdateVehicleRequest $request, string $id): JsonResponse
    {
        $vehicle = $this->vehicleService->updateVehicle($id, $request->validated());
        return response()->json(new VehicleResource($vehicle));
    }

    public function updatePartial(UpdateVehicleRequest $request, string $id): JsonResponse
    {
        $vehicle = $this->vehicleService->updateVehiclePartial($id, $request->validated());
        return response()->json(new VehicleResource($vehicle));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->vehicleService->deleteVehicle($id);
        return response()->json(null, 204);
    }

    public function getSchedule(string $id, Request $request): JsonResponse
    {
        $schedule = $this->vehicleService->getVehicleSchedule(
            $id,
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json($schedule);
    }
}
