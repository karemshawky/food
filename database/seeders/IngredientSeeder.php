<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::factory()->create([
            'name' => 'Beef',
            'used_stock' => 11000,
            'main_stock' => 20000,
        ]);

        Ingredient::factory()->create([
            'name' => 'Cheese',
            'used_stock' => 3000,
            'main_stock' => 5000,
        ]);

        Ingredient::factory()->create([
            'name' => 'Onion',
            'used_stock' => 600,
            'main_stock' => 1000,
        ]);
    }
}
