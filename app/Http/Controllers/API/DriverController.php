<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DriverService;
use App\Http\Resources\DriverResource;
use App\Http\Requests\CreateDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class DriverController extends Controller
{
    public function __construct(
        private readonly DriverService $driverService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $drivers = $this->driverService->listDrivers(
            $request->query('territory_id'),
            $request->query('status'),
            $request->query('availability')
        );
        return response()->json(DriverResource::collection($drivers));
    }

    public function store(CreateDriverRequest $request): JsonResponse
    {
        $driver = $this->driverService->createDriver($request->validated());
        return response()->json(new DriverResource($driver), 201);
    }

    public function show(string $id): JsonResponse
    {
        $driver = $this->driverService->getDriver($id);
        return response()->json(new DriverResource($driver));
    }

    public function update(UpdateDriverRequest $request, string $id): JsonResponse
    {
        $driver = $this->driverService->updateDriver($id, $request->validated());
        return response()->json(new DriverResource($driver));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->driverService->deleteDriver($id);
        return response()->json(null, 204);
    }

    public function getSchedule(string $id, Request $request): JsonResponse
    {
        $schedule = $this->driverService->getDriverSchedule(
            $id,
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json($schedule);
    }

    public function updatePartial(UpdateDriverRequest $request, string $id): JsonResponse
    {
        $driver = $this->driverService->updateDriverPartial($id, $request->validated());
        return response()->json(new DriverResource($driver));
    }
}
