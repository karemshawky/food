<?php

namespace App\Services;

use App\Mail\NotifyLowStockEmail;
use Illuminate\Support\Facades\Mail;
use App\Repositories\ProductRepository;
use App\Repositories\IngredientRepository;

class IngredientService
{
    /**
     * Ingredient Repository constructor.
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
        $product = $this->productRepository->findById(modelId: $payload['product_id'], relations: ['ingredients']);

        return $this->calculateNewStock($product, $payload);
    }

    /**
     * Calculate the new ingredient stock.
     *
     * @param object $product
     * @param array $payload
     * @return void
     */
    public function calculateNewStock($product, $payload)
    {
        foreach ($product->ingredients->toArray() as $ingredient) {

            // Calculate the new stock after the orders.
            $orderQuantity = $ingredient['pivot']['quantity'] * $payload['quantity'];
            $newStock = $ingredient['used_stock'] - $orderQuantity;

            // Fresh the ingredient row with the new stock.
            $this->ingredientRepository->update($ingredient['id'], ['used_stock' => (int) $newStock > 0 ? $newStock : 0]);

            // Send email to notify user if ingredient stock is Low.
            $this->notifyLowStock($ingredient);
        }
    }

    /**
     * Send email to notify user if stock is Low.
     *
     * @param array $ingredient
     * @return void
     */
    public function notifyLowStock($ingredient)
    {
        $stockPercentage = $ingredient['used_stock'] / $ingredient['main_stock'] * 100;

        if ($stockPercentage <= (float) 50 and $ingredient['low_stock'] == false) {

            $this->ingredientRepository->update($ingredient['id'], ['low_stock' => true]);

            // Mail::to('merchant@example.com')->send(new NotifyLowStockEmail($ingredient));
        }
    }
}
