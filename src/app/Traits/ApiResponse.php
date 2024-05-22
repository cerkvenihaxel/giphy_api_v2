<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse as JsonResponse;


trait ApiResponse{

    protected function success($message, $statusCode = 200): JsonResponse{
        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], 200);
    }

     protected function invalid($message, $statusCode = 400): JsonResponse{
         return response()->json([
             'message' => $message,
             'status' => $statusCode
         ], 400);
    }

    protected function successBody($response): JsonResponse{
        return response()->json([
            $response
        ], 200);
    }

}
