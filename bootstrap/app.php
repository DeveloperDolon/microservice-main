<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('api', [
            // Authenticate::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Unauthenticated.',
                'status' => 401
            ], 401);
        });

        $exceptions->render(function (\Exception $e, Request $request) {
            $status = 500;

            if ($e instanceof HttpException) {
                $status = $e->getStatusCode();
            }

            if ($e instanceof ValidationException) {
                $status = 422;
            } 

            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
                'status' => $status,
            ], $status);
        });
    })->create();
