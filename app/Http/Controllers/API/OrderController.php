<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $orders = $this->orderService->listOrders(
            $request->query('territory_id'),
            $request->query('status'),
            $request->query('date_from'),
            $request->query('date_to')
        );
        return response()->json(OrderResource::collection($orders));
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated());
        return response()->json(new OrderResource($order), 201);
    }

    public function show(string $id): JsonResponse
    {
        $order = $this->orderService->getOrder($id);
        return response()->json(new OrderResource($order));
    }

    public function update(UpdateOrderRequest $request, string $id): JsonResponse
    {
        $order = $this->orderService->updateOrder($id, $request->validated());
        return response()->json(new OrderResource($order));
    }

    public function destroy(string $id): JsonResponse
    {
        $this->orderService->deleteOrder($id);
        return response()->json(null, 204);
    }

    public function getExecutionDetails(string $id): JsonResponse
    {
        $details = $this->orderService->getExecutionDetails($id);
        return response()->json($details);
    }

    public function getItems(string $id): JsonResponse
    {
        $items = $this->orderService->getOrderItems($id);
        return response()->json($items);
    }

    public function getPodDetails(string $id): JsonResponse
    {
        $pod = $this->orderService->getPodDetails($id);
        return response()->json($pod);
    }

    public function getWidgetInfo(string $id): JsonResponse
    {
        $info = $this->orderService->getWidgetInfo($id);
        return response()->json($info);
    }
}
