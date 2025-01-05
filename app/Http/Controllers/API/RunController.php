<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\RunService;
use App\Http\Resources\RunResource;
use App\Http\Requests\CreateRunRequest;
use App\Http\Requests\UpdateRunRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RunController extends Controller
{
    public function __construct(
        private readonly RunService $runService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $runs = $this->runService->listRuns(
            $request->query('territory_id'),
            $request->query('status'),
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json(RunResource::collection($runs));
    }

    public function store(CreateRunRequest $request): JsonResponse
    {
        $run = $this->runService->createRun($request->validated());
        return response()->json(new RunResource($run), 201);
    }

    public function show(string $id): JsonResponse
    {
        $run = $this->runService->getRun($id);
        return response()->json(new RunResource($run));
    }

    public function update(UpdateRunRequest $request, string $id): JsonResponse
    {
        $run = $this->runService->updateRun($id, $request->validated());
        return response()->json(new RunResource($run));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->runService->deleteRun($id);
        return response()->json(null, 204);
    }

    public function getSchedule(string $id, Request $request): JsonResponse
    {
        $schedule = $this->runService->getRunSchedule(
            $id,
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json($schedule);
    }

    public function getOrders(string $id): JsonResponse
    {
        $orders = $this->runService->getRunOrders($id);
        return response()->json($orders);
    }

    public function addOrder(string $id, string $orderId): JsonResponse
    {
        $run = $this->runService->addOrderToRun($id, $orderId);
        return response()->json(new RunResource($run));
    }

    public function removeOrder(string $id, string $orderId): JsonResponse
    {
        $run = $this->runService->removeOrderFromRun($id, $orderId);
        return response()->json(new RunResource($run));
    }
}
