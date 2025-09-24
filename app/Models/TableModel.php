<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableModel extends Model
{
    use HasFactory;

    protected $table = 'tables'; // Explicitly define the table name

    protected $fillable = [
        'table_number',
        'barcode',
        'capacity',
        'location',
        'is_active',
    ];

    // Relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}