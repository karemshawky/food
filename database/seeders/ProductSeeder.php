<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $burger = Product::factory()->create([
            'name' => 'Burger',
            'description' => 'beef-burger'
        ]);

        $beef = Ingredient::factory()->create([
            'name' => 'Beef',
            'used_stock' => 11000,
            'main_stock' => 20000,
        ]);

        $cheese = Ingredient::factory()->create([
            'name' => 'Cheese',
            'used_stock' => 3000,
            'main_stock' => 5000,
        ]);

        $onion = Ingredient::factory()->create([
            'name' => 'Onion',
            'used_stock' => 600,
            'main_stock' => 1000,
        ]);

        $burger->ingredients()->attach([
            $beef->id => ['quantity' => 150],
            $cheese->id => ['quantity' => 30],
            $onion->id => ['quantity' => 20]
        ]);
    }
}
