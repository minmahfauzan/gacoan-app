<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [];
        for ($i = 1; $i <= 20; $i++) {
            $tables[] = [
                'table_number' => 'TBL-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'barcode' => 'BARCODE-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'capacity' => rand(2, 6),
                'location' => 'Floor ' . rand(1, 3),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('tables')->insert($tables);
    }
}