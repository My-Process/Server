<?php

namespace App\Traits\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /** Generate Response Data Array */
    protected function generateData(mixed $data, string $message, int $statusCode): array
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }

        return [
            'message' => $message,
            'data'    => $data,
        ];
    }

    /** Generic message for successful Responses */
    public function successResponse(mixed $data = [], string $message = '', int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $data = $this->generateData($data, $message, $statusCode);

        return new JsonResponse($data, $statusCode);
    }

    /** Generic message for unsuccessful Responses */
    public function errorResponse(mixed $data = [], string $message = '', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $data = $this->generateData($data, $message, $statusCode);

        return new JsonResponse($data, $statusCode);
    }

    /** Message for Ok Response */
    public function okResponse(mixed $data, string $message = ''): JsonResponse
    {
        return $this->successResponse($data, $message);
    }

    /** Message for Created Response */
    public function createdResponse(mixed $data, string $message = ''): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_CREATED);
    }

    /** Message for No Content Response */
    public function noContentResponse(string $message = ''): JsonResponse
    {
        return $this->successResponse([], $message, Response::HTTP_NO_CONTENT);
    }

    /** Message for Bad Request Response */
    public function badRequestResponse(string $message = '', mixed $data = []): JsonResponse
    {
        return $this->errorResponse($data, $message, Response::HTTP_BAD_REQUEST);
    }

    /** Message for Unauthorized Response */
    public function unauthorizedResponse(string $message = '', mixed $data = []): JsonResponse
    {
        return $this->errorResponse($data, $message, Response::HTTP_UNAUTHORIZED);
    }

    /** Message for Forbidden Response */
    public function forbiddenResponse(string $message = '', mixed $data = []): JsonResponse
    {
        return $this->errorResponse($data, $message, Response::HTTP_FORBIDDEN);
    }

    /** Message for Not Found Response */
    public function notFoundResponse(string $message = '', mixed $data = []): JsonResponse
    {
        return $this->errorResponse($data, $message, Response::HTTP_NOT_FOUND);
    }

    /** Message for Conflict Response */
    public function conflictResponse(string $message = '', mixed $data = []): JsonResponse
    {
        return $this->errorResponse($data, $message, Response::HTTP_CONFLICT);
    }

    /** Message for Unprocessable Response */
    public function unprocessableResponse(string $message = '', mixed $data = []): JsonResponse
    {
        return $this->errorResponse($data, $message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
