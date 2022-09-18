<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    public function store(OrderRequest $request): JsonResponse
    {
        $this->orderService->createOrder($request->toArray());

        return response()->json(['message' => 'Created Successfully'], JsonResponse::HTTP_CREATED);
    }
}
