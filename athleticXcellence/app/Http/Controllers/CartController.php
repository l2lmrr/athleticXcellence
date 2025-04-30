<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function store(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$product->stock
        ]);

        $cartItem = auth()->user()->cartItems()->firstOrNew([
            'product_id' => $product->id
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return back()->with('success', 'Product added to cart!');
    }

    public function update(CartItem $cartItem, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$cartItem->product->stock
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated!');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return back()->with('success', 'Item removed from cart');
    }
}