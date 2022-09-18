<?php

namespace Database\Seeders;

use App\Models\Product;
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

        $burger->ingredients()->attach([
            1 => ['quantity' => 150],
            2 => ['quantity' => 30],
            3 => ['quantity' => 20]
        ]);
    }
}
