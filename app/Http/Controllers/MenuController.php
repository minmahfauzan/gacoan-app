<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with([
            'products' => function ($query) {
                $query->orderBy('is_active', 'desc');
            }
        ])
        ->where('is_active', true)
        ->orderBy('name')
        ->get();
            
        return view('menu.index', compact('categories'));
    }
}