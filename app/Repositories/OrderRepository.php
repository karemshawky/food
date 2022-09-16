<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository
{
    /**
     * BaseRepository constructor.
     *
     * @param \App\Models\Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * Create a model.
     *
     * @param array $payload
     * @return \App\Models\Order
     */
    public function create(array $payload): ?Order
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }
}
