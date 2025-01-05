<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PodService;
use App\Http\Resources\PodResource;
use App\Http\Requests\CreatePodRequest;
use App\Http\Requests\UpdatePodRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PodController extends Controller
{
    public function __construct(
        private readonly PodService $podService
    ) {}

    public function show(string $orderId): JsonResponse
    {
        $pod = $this->podService->getPod($orderId);
        return response()->json(new PodResource($pod));
    }

    public function store(CreatePodRequest $request, string $orderId): JsonResponse
    {
        $pod = $this->podService->createPod($orderId, $request->validated());
        return response()->json(new PodResource($pod), 201);
    }

    public function update(UpdatePodRequest $request, string $orderId): JsonResponse
    {
        $pod = $this->podService->updatePod($orderId, $request->validated());
        return response()->json(new PodResource($pod));
    }

    public function uploadPhoto(Request $request, string $orderId): JsonResponse
    {
        $request->validate([
            'photo' => 'required|image|max:10240', // Max 10MB
            'description' => 'nullable|string',
        ]);

        $pod = $this->podService->uploadPodPhoto($orderId, $request->file('photo'), $request->input('description'));
        return response()->json(new PodResource($pod));
    }

    public function deletePhoto(string $orderId, string $photoId): JsonResponse
    {
        $this->podService->deletePodPhoto($orderId, $photoId);
        return response()->json(null, 204);
    }

    public function addNote(Request $request, string $orderId): JsonResponse
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $pod = $this->podService->addPodNote($orderId, $request->input('note'));
        return response()->json(new PodResource($pod));
    }

    public function getHistory(string $orderId): JsonResponse
    {
        $history = $this->podService->getPodHistory($orderId);
        return response()->json($history);
    }
}
