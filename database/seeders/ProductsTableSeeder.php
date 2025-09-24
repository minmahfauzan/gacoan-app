<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs
        $categories = DB::table('categories')->pluck('id', 'name')->toArray();
        
        $products = [
            // Chicken Series
            [
                'name' => 'Chicken Geprek',
                'description' => 'Spicy fried chicken with sambal',
                'price' => 25000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Chicken Series'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chicken Geprek Keju',
                'description' => 'Spicy fried chicken with cheese',
                'price' => 28000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Chicken Series'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chicken Geprek Mozzarella',
                'description' => 'Spicy fried chicken with mozzarella',
                'price' => 30000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Chicken Series'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Duck Series
            [
                'name' => 'Duck Geprek',
                'description' => 'Spicy fried duck with sambal',
                'price' => 32000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Duck Series'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duck Geprek Keju',
                'description' => 'Spicy fried duck with cheese',
                'price' => 35000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Duck Series'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Seafood
            [
                'name' => 'Cumi Geprek',
                'description' => 'Spicy fried squid with sambal',
                'price' => 30000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Seafood'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Udang Geprek',
                'description' => 'Spicy fried shrimp with sambal',
                'price' => 32000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Seafood'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Vegetables
            [
                'name' => 'Tahu Geprek',
                'description' => 'Spicy fried tofu with sambal',
                'price' => 15000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Vegetables'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tempe Geprek',
                'description' => 'Spicy fried tempe with sambal',
                'price' => 15000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Vegetables'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Noodles
            [
                'name' => 'Mie Geprek',
                'description' => 'Spicy noodles with geprek sauce',
                'price' => 20000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Noodles'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Geprek Keju',
                'description' => 'Spicy noodles with cheese',
                'price' => 23000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Noodles'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Rice
            [
                'name' => 'Nasi Geprek',
                'description' => 'Spicy rice with geprek chicken',
                'price' => 22000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Rice'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Drinks
            [
                'name' => 'Es Teh Manis',
                'description' => 'Sweet iced tea',
                'price' => 5000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Drinks'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Es Jeruk',
                'description' => 'Fresh orange juice',
                'price' => 7000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Drinks'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mineral Water',
                'description' => 'Bottled mineral water',
                'price' => 3000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Drinks'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Desserts
            [
                'name' => 'Es Campur',
                'description' => 'Mixed fruit dessert',
                'price' => 12000,
                'image' => null,
                'is_available' => true,
                'category_id' => $categories['Desserts'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('products')->insert($products);
    }
}