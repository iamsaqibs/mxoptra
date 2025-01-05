<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DistributionCenterService;
use App\Http\Resources\DistributionCenterResource;
use App\Http\Requests\CreateDistributionCenterRequest;
use App\Http\Requests\UpdateDistributionCenterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class DistributionCenterController extends Controller
{
    public function __construct(
        private readonly DistributionCenterService $distributionCenterService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $centers = $this->distributionCenterService->listDistributionCenters(
            $request->query('territory_id'),
            $request->query('status')
        );
        return response()->json(DistributionCenterResource::collection($centers));
    }

    public function store(CreateDistributionCenterRequest $request): JsonResponse
    {
        $center = $this->distributionCenterService->createDistributionCenter($request->validated());
        return response()->json(new DistributionCenterResource($center), 201);
    }

    public function show(string $id): JsonResponse
    {
        $center = $this->distributionCenterService->getDistributionCenter($id);
        return response()->json(new DistributionCenterResource($center));
    }

    public function update(UpdateDistributionCenterRequest $request, string $id): JsonResponse
    {
        $center = $this->distributionCenterService->updateDistributionCenter($id, $request->validated());
        return response()->json(new DistributionCenterResource($center));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->distributionCenterService->deleteDistributionCenter($id);
        return response()->json(null, 204);
    }

    public function getSchedule(string $id, Request $request): JsonResponse
    {
        $schedule = $this->distributionCenterService->getDistributionCenterSchedule(
            $id,
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json($schedule);
    }

    public function getCapacity(string $id, Request $request): JsonResponse
    {
        $capacity = $this->distributionCenterService->getDistributionCenterCapacity(
            $id,
            $request->query('date')
        );
        return response()->json($capacity);
    }

    public function getWorkload(string $id, Request $request): JsonResponse
    {
        $workload = $this->distributionCenterService->getDistributionCenterWorkload(
            $id,
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json($workload);
    }
}
