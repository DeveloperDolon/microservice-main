<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        $loginCredentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt($loginCredentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendSuccessResponse([
                'user' => $user,
                'token' => $token,
            ], 'Login successful');
        }
        return $this->sendErrorResponse('Invalid credentials', 401);
    }

    public function me()
    {
        $user = request()->user();
        return $this->sendSuccessResponse($user, 'User retrieved successfully');
    }

    public function updateProfile(AuthRequest $request)
    {
        $user = request()->user();
        $validatedData = $request->validated();

        $user->name = $validatedData['name'] ?? $user->name;
        $user->email = $validatedData['email'] ?? $user->email;
        $user->phone = $validatedData['phone'] ?? $user->phone;
        $user->dob = $validatedData['dob'] ?? $user->dob;
        $user->bio = $validatedData['bio'] ?? $user->bio;

        if ($request->hasFile('avatar')) {
            $user->avatar = upload_image($request->file('avatar'));
        }

        $user->save();

        return $this->sendSuccessResponse($user, 'Profile updated successfully');
    }

    public function logout()
    {
        $user = request()->user();
        $user->tokens()->delete();

        return $this->sendSuccessResponse(null, 'Logout successful');
    }
}
