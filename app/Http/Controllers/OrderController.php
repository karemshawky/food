<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    public function __construct(
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $this->orderRepository->create($request->toArray());

        return response()->json(['message' => 'Created Successfully'], JsonResponse::HTTP_CREATED);
    }
}
