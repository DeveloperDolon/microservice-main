<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $condition = $this->isMethod('post') ? 'required' : 'sometimes';

        return [
            'quantity' =>  $condition . '|integer|min:1',
            'price' =>  $condition . '|numeric|min:1',
            'discount_amount' =>  $condition . '|numeric|min:1',
            'customer_id' =>  $condition . '|string',
            'coupon_applied' =>  $condition . '|boolean',
            'coupon_code' =>  'nullable|string|max:255',
        ];
    }
}
