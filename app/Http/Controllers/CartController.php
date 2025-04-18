<?php

namespace App\Http\Controllers;

use App\Jobs\VariantUpdateJob;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Variant;
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

        $variant = Variant::find($cartItemData['variant_id']);
        if(!($variant->stock >= $cartItemData['quantity'])) {
            return $this->sendErrorResponse('Insufficient product quantity!', 400);
        }

        $variant->stock = $variant->stock - $cartItemData['quantity'];
        $variant->save();

        VariantUpdateJob::dispatch($variant->toArray())->onConnection('rabbitmq')->onQueue('admin_queue');

        if($cartIsExist) {
            $cartItem = CartItem::where('variant_id', $cartItemData['variant_id'])
            ->orWhere('product_id', $cartItemData['product_id'])
            ->first();

            if($cartItem) {
                $cartItem->quantity = $cartItem->quantity + $cartItemData['quantity'];
                $cartItem->save();
            } else {
                $cartItem = CartItem::create([
                    'cart_id' => $cartIsExist->id,
                    'product_id' => $cartItemData['product_id'],
                    'quantity' => $cartItemData['quantity'],
                    'variant_id' => $cartItemData['variant_id'],
                ]);
            }

            $cartIsExist->quantity = $cartIsExist->quantity + $cartItemData['quantity'];
            $cartIsExist->price = $cartIsExist->price + ($variant->price * $cartItemData['quantity']);
            $cartIsExist->save();

            $cartItem->load('cart');
            return $this->sendSuccessResponse($cartItem, 'Product added to cart successfully', 200);
        } else {
            $cart = Cart::create([
                'customer_id' => request()->user()->id,
                'price' => $variant->price * $cartItemData['quantity'],
                'discount_amount' => 0,
                'coupon_code' => null,
                'quantity' => $cartItemData['quantity'],
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

    public function show() {
        $cart = Cart::where('customer_id', request()->user()->id)
        ->with('items')
        ->first();

        return $this->sendSuccessResponse($cart, 'User cart data retrieved successful!');
    }
}
