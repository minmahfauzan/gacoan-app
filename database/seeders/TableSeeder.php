<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TableModel;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            TableModel::create([
                'table_number' => (string)$i,
                'barcode' => 'GACOAN-TABLE-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'capacity' => 4,
                'is_active' => true,
            ]);
        }
    }
}
