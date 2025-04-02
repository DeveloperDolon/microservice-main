<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $condition = $this->isMethod('post') ? 'required' : 'sometimes';
        return [
            'name' => $condition . '|string|max:255',
            'email' => $condition . '|email|max:255|unique:users,email',
            'password' => $condition . '|string|max:255|',
            'phone' => 'nullable|string|max:255',
            'dob' => 'nullable|string|max:255',
            'bio' => $condition . '|string',
            'avatar' => 'nullable|string|max:255',
        ];
    }
}
