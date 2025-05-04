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
            'quantity' => 'required|integer|min:1|max:'.$product->stock,
            'size' => 'required|in:S,M,L,XL'
        ]);
    
        $cartItem = auth()->user()->cartItems()->firstOrNew([
            'product_id' => $product->id,
            'size' => $request->size
        ]);
    
        $newQuantity = $cartItem->exists ? $cartItem->quantity + $request->quantity : $request->quantity;
        
        if ($newQuantity > $product->stock) {
            return back()->with('error', 'The requested quantity exceeds available stock.');
        }
    
        $cartItem->quantity = $newQuantity;
        $cartItem->save();
    

        return response()->json([
            'success' => true,
            'cart_count' => auth()->user()->cartItems()->count()
        ]);
        }

    public function update(CartItem $cartItem, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$cartItem->product->stock
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'cart_count' => auth()->user()->cartItems()->count(),
            'subtotal' => auth()->user()->cartItems()->with('product')->get()->sum(function($item) {
                return $item->product->price * $item->quantity;
            }),
            'product_stock' => $cartItem->product->stock,
            'item_price' => $cartItem->product->price
        ]);
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return response()->json([
            'success' => true,
            'cart_count' => auth()->user()->cartItems()->count(),
            'subtotal' => auth()->user()->cartItems()->with('product')->get()->sum(function($item) {
                return $item->product->price * $item->quantity;
            })
        ]);
    }
}