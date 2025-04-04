<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function add(Request $request)
    {
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
