<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
            $status = 500;
            $message = 'Internal Server Error';
            $errors = [];

            // Handle specific exception types
            switch (true) {
                case $e instanceof ValidationException:
                    $status = 422;
                    $message = 'Validation Error';
                    $errors = $e->errors();
                    break;

                case $e instanceof AuthenticationException:
                    $status = 401;
                    $message = 'Unauthenticated';
                    break;

                case $e instanceof AuthorizationException:
                    $status = 403;
                    $message = 'Forbidden';
                    break;

                case $e instanceof NotFoundHttpException:
                case $e instanceof ModelNotFoundException:
                    $status = 404;
                    $message = 'Resource Not Found';
                    break;

                case $e instanceof MethodNotAllowedHttpException:
                    $status = 405;
                    $message = 'Method Not Allowed';
                    break;

                case $e instanceof HttpResponseException:
                case $e instanceof HttpException:
                    $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
                    $message = $e->getMessage() ?: Response::$statusTexts[$status] ?? 'Http Exception';
                    break;

                default:
                    $message = $e->getMessage() ?: 'Unexpected Error';
                    break;
            }

            return response()->json([
                'response' => [
                    'status' => [
                        'code' => $status,
                        'message' => $message,
                    ],
                    'records' => $errors,
                ]
            ], $status);
        });
    })->create();
