<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mie = Category::where('name', 'Mie Gacoan')->first();
        $dimsum = Category::where('name', 'Dimsum')->first();
        $minuman = Category::where('name', 'Minuman')->first();

        // Mie Products
        Product::create(['category_id' => $mie->id, 'name' => 'Mie Suit', 'price' => 10000]);
        Product::create(['category_id' => $mie->id, 'name' => 'Mie Hompimpa', 'price' => 10000]);
        Product::create(['category_id' => $mie->id, 'name' => 'Mie Gacoan', 'price' => 9000]);

        // Dimsum Products
        Product::create(['category_id' => $dimsum->id, 'name' => 'Udang Keju', 'price' => 9000]);
        Product::create(['category_id' => $dimsum->id, 'name' => 'Udang Rambutan', 'price' => 9000]);
        Product::create(['category_id' => $dimsum->id, 'name' => 'Siomay', 'price' => 9000]);

        // Minuman Products
        Product::create(['category_id' => $minuman->id, 'name' => 'Es Gobak Sodor', 'price' => 8000]);
        Product::create(['category_id' => $minuman->id, 'name' => 'Es Teklek', 'price' => 6000]);
        Product::create(['category_id' => $minuman->id, 'name' => 'Es Petak Umpet', 'price' => 8000]);
    }
}
