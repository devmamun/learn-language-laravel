<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    /**
     * Generic JSON response formatter.
     */
    public function response(array $data = [], int $statusCode = Response::HTTP_OK, string $message = ''): JsonResponse
    {
        if (empty($message)) {
            $message = Response::$statusTexts[$statusCode] ?? 'Unknown Status';
        }

        return response()->json([
            'response' => [
                'status' => [
                    'code' => $statusCode,
                    'message' => $message,
                ],
                'records' => $data,
            ]
        ], $statusCode);
    }

    /**
     * 2xx: Successful responses
     */
    public function success(array $data = [], string $message = '', int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->response($data, $statusCode, $message);
    }

    /**
     * 4xx / 5xx: Error responses
     */
    public function error(array $errors = [], string $message = '', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->response($errors, $statusCode, $message);
    }

    // Shortcut methods

    public function ok(array $data = [], string $message = 'OK'): JsonResponse
    {
        return $this->success($data, $message, Response::HTTP_OK);
    }

    public function created(array $data = [], string $message = 'Created'): JsonResponse
    {
        return $this->success($data, $message, Response::HTTP_CREATED);
    }

    public function badRequest(array $data = [], string $message = 'Bad Request'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_BAD_REQUEST);
    }

    public function unauthorized(array $data = [], string $message = 'Unauthorized'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_UNAUTHORIZED);
    }

    public function forbidden(array $data = [], string $message = 'Forbidden'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_FORBIDDEN);
    }

    public function notFound(array $data = [], string $message = 'Not Found'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_NOT_FOUND);
    }

    public function conflict(array $data = [], string $message = 'Conflict'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_CONFLICT);
    }

    public function unprocessable(array $data = [], string $message = 'Unprocessable Entity'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function methodNotAllowed(array $data = [], string $message = 'Method Not Allowed'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public function serviceUnavailable(array $data = [], string $message = 'Service Unavailable'): JsonResponse
    {
        return $this->error($data, $message, Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
