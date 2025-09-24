<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('menu.index', compact('categories'));
    }
}