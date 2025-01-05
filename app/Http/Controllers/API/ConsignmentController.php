<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ConsignmentService;
use App\Http\Resources\ConsignmentResource;
use App\Http\Requests\CreateConsignmentRequest;
use App\Http\Requests\UpdateConsignmentStatusRequest;
use Illuminate\Http\JsonResponse;

final class ConsignmentController extends Controller
{
    public function __construct(
        private readonly ConsignmentService $consignmentService
    ) {}

    public function getConsignment(string $referenceNumber): JsonResponse
    {
        $consignment = $this->consignmentService->getConsignment($referenceNumber);
        return response()->json(new ConsignmentResource($consignment));
    }

    public function createConsignment(CreateConsignmentRequest $request): JsonResponse
    {
        $consignment = $this->consignmentService->createConsignment(
            $request->input('pickup_order_id'),
            $request->input('delivery_order_id'),
            $request->input('reference_number'),
            $request->input('metadata', [])
        );
        return response()->json(new ConsignmentResource($consignment), 201);
    }

    public function updateConsignmentStatus(UpdateConsignmentStatusRequest $request, string $referenceNumber): JsonResponse
    {
        $consignment = $this->consignmentService->updateStatus(
            $referenceNumber,
            $request->input('status')
        );
        return response()->json(new ConsignmentResource($consignment));
    }

    public function getConsignmentsByOrder(string $orderId): JsonResponse
    {
        $consignments = $this->consignmentService->getConsignmentsByOrder($orderId);
        return response()->json(ConsignmentResource::collection($consignments));
    }

    public function getConsignmentHistory(string $referenceNumber): JsonResponse
    {
        $history = $this->consignmentService->getConsignmentHistory($referenceNumber);
        return response()->json(['history' => $history]);
    }
}
