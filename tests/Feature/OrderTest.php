<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    const STORE_ROUTE = 'api.orders.store';

    /**
     * Setup the class.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create();
        $this->ingredient = Ingredient::factory()->create();

        $this->product->ingredients()->attach([
            $this->ingredient->id => ['quantity' => $this->faker->randomDigitNotNull()]
        ]);

        $this->order = [
            'product_id' => $this->product->id,
            'quantity' => $this->faker->randomDigitNotNull(),
        ];
    }

    /**
     * Required fields for make order test.
     *
     * @return void
     */
    public function test_required_fields_for_make_order()
    {
        $this->postJson(route(self::STORE_ROUTE))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(
                [
                    'product_id' => ['The product id field is required.'],
                    'quantity' => ['The quantity field is required.'],
                ]
            );
    }

    /**
     * Test make order successfully.
     *
     * @return void
     */
    public function test_make_order_successfully()
    {
        $this->postJson(route(self::STORE_ROUTE), $this->order)
            ->assertCreated()
            ->assertJsonStructure(['message']);

        $this->assertDatabaseHas('orders', ['product_id' => $this->order['product_id'], 'quantity' => $this->order['quantity']]);
    }

    /**
     * Test update stock after make order successfully.
     *
     * @return void
     */
    public function test_update_stock_after_make_order_successfully()
    {
        $this->postJson(route(self::STORE_ROUTE), $this->order)
            ->assertCreated()
            ->assertJsonStructure(['message']);

        $this->assertNotEquals($this->ingredient->used_stock, $this->ingredient->fresh()->used_stock);
        $this->assertDatabaseHas('ingredients', ['used_stock' => $this->ingredient->fresh()->used_stock]);
    }
}
