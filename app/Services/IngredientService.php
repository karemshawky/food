<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\IngredientRepository;

class IngredientService
{
    /**
     * IngredientRepository constructor.
     *
     * @param \App\Repositories\IngredientRepository $ingredientRepository
     * @param \App\Repositories\ProductRepository $productRepository
     */
    public function __construct(
        protected IngredientRepository $ingredientRepository,
        protected ProductRepository $productRepository
    ) {
    }

    /**
     * Update Stock.
     *
     * @param array $payload
     * @return void
     */
    public function updateStock(array $payload)
    {
        $products = $this->productRepository->findById(modelId: $payload['product_id'], relations: ['ingredients']);

        return $this->calculateNewQuantity($products, $payload);
    }

    /**
     * Update quantity
     *
     * @param object $products
     * @param array $payload
     * @return void
     */
    public function calculateNewQuantity($products, $payload)
    {
        $quantity = [];

        foreach ($products->ingredients->toArray() as $product) {
            $newQuantity = $product['pivot']['quantity'] * $payload['quantity'];
            $quantity[$product['id']] = $product['used_stock'] - $newQuantity;
        }
        
        return $this->updateQuantity($quantity, $product);
    }

    /**
     * Undocumented function
     *
     * @param [type] $quantity
     * @return void
     */
    public function updateQuantity($quantity, $product)
    {
        foreach ($quantity as $key => $value) {
            $this->ingredientRepository->update($key, ['used_stock' => (int) $value > 0 ? $value : 0]);
        }

        $stockPercentage = $product['used_stock'] / $product['main_stock'] * 100;

        if ($stockPercentage <= (float) 50) {
            dd('dffdgfdgfhgfhfhghgfgfh');
            // Mail::to('john@example.com')->send(new TestEmail($data));
        }
    }
}
