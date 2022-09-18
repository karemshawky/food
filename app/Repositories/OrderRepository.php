<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository
{
    /**
     * Order Repository constructor.
     *
     * @param \App\Models\Order $model
     */
    public function __construct(protected Order $model) {}

}
