<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param $response
     * @param int $status
     * @return JsonResponse
     */
    public function successResponse($response, int $status = 200): JsonResponse
    {
        $data = [];
        $data['data'] = $response;
        $data['status'] = $status;
        return response()->json($data, $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse(string $message, int $status): JsonResponse
    {
        $data = [];
        $data['message'] = $message;
        $data['status'] = $status;
        return response()->json($data, $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function messageResponse(string $message, int $status = 200): JsonResponse
    {
        return response()->json($message, $status);
    }

}
