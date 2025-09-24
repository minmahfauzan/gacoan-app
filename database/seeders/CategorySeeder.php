<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Mie Gacoan',
            'description' => 'Varian mie pedas dengan level yang bisa disesuaikan.'
        ]);

        Category::create([
            'name' => 'Dimsum',
            'description' => 'Berbagai macam dimsum kukus dan goreng.'
        ]);

        Category::create([
            'name' => 'Minuman',
            'description' => 'Minuman segar untuk menemani santapan pedasmu.'
        ]);
    }
}
