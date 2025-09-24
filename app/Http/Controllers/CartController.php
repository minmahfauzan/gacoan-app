<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        // Check if request is AJAX
        if (request()->ajax()) {
            return view('partials.cart-items', compact('cart', 'total'))->render();
        }
        
        return view('cart.index', compact('cart', 'total'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        $cart = Session::get('cart', []);
        
        $productId = $product->id;
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity
            ];
        }
        
        Session::put('cart', $cart);
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $total,
            'cart_items' => $cart
        ]);
    }
    
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        
        $cart = Session::get('cart', []);
        
        $productId = $request->product_id;
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $total,
            'cart_items' => $cart
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            if ($request->quantity > 0) {
                $cart[$productId]['quantity'] = $request->quantity;
            } else {
                unset($cart[$productId]);
            }
            Session::put('cart', $cart);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $total,
            'cart_items' => $cart
        ]);
    }
}