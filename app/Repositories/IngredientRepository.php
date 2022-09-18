<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Ingredient;

class IngredientRepository extends BaseRepository
{
    /**
     * Ingredient Repository constructor.
     *
     * @param \App\Models\Ingredient $model
     */
    public function __construct(protected Ingredient $model) {}

}
