<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LoadingService;
use App\Http\Resources\LoadingInfoResource;
use App\Http\Requests\UpdateLoadingRequest;
use Illuminate\Http\JsonResponse;

final class LoadingController extends Controller
{
    public function __construct(
        private readonly LoadingService $loadingService
    ) {}

    public function getLoadingStatus(string $type, string $id): JsonResponse
    {
        $loading = $this->loadingService->getLoadingStatus($type, $id);
        return response()->json(new LoadingInfoResource($loading));
    }

    public function updateLoadingStatus(UpdateLoadingRequest $request, string $type, string $id): JsonResponse
    {
        $loading = $this->loadingService->updateLoadingStatus(
            $type,
            $id,
            $request->input('status'),
            $request->input('items_loading_status')
        );
        return response()->json(new LoadingInfoResource($loading));
    }

    public function startLoading(string $type, string $id): JsonResponse
    {
        $loading = $this->loadingService->startLoading($type, $id);
        return response()->json(new LoadingInfoResource($loading));
    }

    public function completeLoading(string $type, string $id): JsonResponse
    {
        $loading = $this->loadingService->completeLoading($type, $id);
        return response()->json(new LoadingInfoResource($loading));
    }

    public function getLoadingHistory(string $type, string $id): JsonResponse
    {
        $history = $this->loadingService->getLoadingHistory($type, $id);
        return response()->json(['loading_history' => $history]);
    }
}
