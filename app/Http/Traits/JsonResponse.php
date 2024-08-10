<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponse
{
    /**
     * This is for success response
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return Response
     */
    public function successResponse(
        mixed $data,
        string $message = "Operation Successful",
        int $statusCode = Response::HTTP_OK
    ): Response {
        $response = [
            "success" => true,
            "data" => $data,
            "message" => $message
        ];

        return response()->json($response, $statusCode);
    }


    /**
     * @param $data
     * @param string|null $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(
        $data,
       string|null $message = null,
        int $statusCode = Response::HTTP_BAD_REQUEST
    ): \Illuminate\Http\JsonResponse
    {
        $response = ["success" => false, "message" => $message];

        if (!is_null($data)) {
            $response["data"] = $data;
        }
        return response()->json($response, $statusCode);
    }

    /**
     * @param Exception $e
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function fatalErrorResponse(
        Exception $e,
       string $message = 'Oops! Something went wrong on the server. Try again in a few moments or contact support team.',
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): \Illuminate\Http\JsonResponse
    {
        Log::error($e);

        $line = $e->getTrace();
        $error = [
            "message" => $e->getMessage(),
            "trace" => $line[0],
            "mini_trace" => $line[1]
        ];

        return response()->json([
            "success" => false,
            "message" => $message,
            "error" => $error
        ], $statusCode);
    }

    /**
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond(Exception $e): \Illuminate\Http\JsonResponse
    {
        Log::error($e);

        $trace = [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'code' => $e->getCode(),
            'time' => now()->toDayDateTimeString(),
        ];

        $code = $e->getCode() ?: 500;
        if ($code < 500) {
            return $this->errorResponse(null, $e->getMessage(), $code);
        }
        return $this->fatalErrorResponse($e);
    }
}
