<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    /**
     * Product Repository constructor.
     *
     * @param \App\Models\Product $model
     */
    public function __construct(protected Product $model) {}

}
