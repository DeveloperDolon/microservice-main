<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function signup(AuthRequest $request)
    {
        $validatedData = $request->validated();
        $avater = null;
        if($request->hasFile('avatar')) {
            $avater = upload_image($request->file('avatar'));
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'phone' => $validatedData['phone'] ?? null,
            'dob' => $validatedData['dob'] ?? null,
            'bio' => $validatedData['bio'],
            'avatar' => $avater,
        ]);

        return $this->sendSuccessResponse($user, 'User created successfully', 201);
    }
}
