<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

trait ValidatorResponse
{
    /**
     * Check if validation fails and return JSON response if it does.
     *
     * @param Validator $validator
     * @return JsonResponse|null
     */
    protected function validationFails(Validator $validator): ?JsonResponse
    {
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        return null;
    }
}
