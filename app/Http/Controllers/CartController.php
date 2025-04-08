<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function add(Request $request)
    {

        $cartItem = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'product_id' => 'required|exists:carts,id',
            'quantity' => 'required|exists:carts,id',
            'variant_id' => 'required|exists:carts,id',
        ]);

        $cartIsExist = Cart::where('customer_id', request()->user()->id)
            ->first();

        if($cartIsExist) {
            
        } else {
            $cart = Cart::create([
                'customer_id' => request()->user()->id,
                'price' => $cartItem['price'],
                'discount_amount' => $cartItem['discount_amount'],
                'coupon_applied' => $cartItem['coupon_applied'],
                'coupon_code' => $cartItem['coupon_code'],
            ]);
        }

        $request->validate([
            'quantity' => 'integer|required',
            'price' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'customer_id' => 'required|exists:users,id',
            'coupon_applied' => 'nullable|boolean',
            'coupon_code' => 'nullable|string|max:255',
        ]);

        return $this->sendSuccessResponse([], 'Product added to cart successfully', 200);
    }
}
