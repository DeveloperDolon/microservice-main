<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function add(Request $request)
    {
        $cartItemData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'required|exists:variants,id',
        ]);        
        
        $cartIsExist = Cart::where('customer_id', request()->user()->id)
            ->first();

        $product = Product::find($cartItemData['product_id']);

        if($cartIsExist) {
            $cartItem = CartItem::create([
                'cart_id' => $cartIsExist->id,
                'product_id' => $cartItemData['product_id'],
                'quantity' => $cartItemData['quantity'],
                'variant_id' => $cartItemData['variant_id'],
            ]);
            $cartItem->load('cart');
            return $this->sendSuccessResponse($cartItem, 'Product added to cart successfully', 200);
        } else {
            $cart = Cart::create([
                'customer_id' => request()->user()->id,
                'price' => $product->price,
                'discount_amount' => 0,
                'coupon_code' => null,
            ]);

            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $cartItemData['product_id'],
                'quantity' => $cartItemData['quantity'],
                'variant_id' => $cartItemData['variant_id'],
            ]);
            $cartItem->load('cart');
            return $this->sendSuccessResponse($cartItem, 'Product added to cart successfully', 200);
        }
    }
}
