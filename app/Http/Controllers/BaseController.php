<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function sendSuccessResponse($data, $message = null, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function sendErrorResponse($message, $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
