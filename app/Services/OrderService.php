<?php

namespace App\Services;

use App\Services\IngredientService;
use App\Repositories\OrderRepository;

class OrderService
{
    /**
     * OrderRepository constructor.
     *
     * @param \App\Repositories\OrderRepository $orderRepository
     * @param \App\Services\IngredientService $ingredientService
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected IngredientService $ingredientService
    ) {
    }

    /**
     * Create order.
     *
     * @param array $payload
     * @return void
     */
    public function createOrder(array $payload)
    {
        $this->orderRepository->create($payload);

        $this->ingredientService->updateStock($payload);
    }
}
