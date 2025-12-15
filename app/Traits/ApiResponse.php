<?php

namespace App\Traits;

trait ApiResponse
{
    protected function apiResponse($data, $msg, $code)
    {

        $response = [
            'status' => $code,
            'message' => $msg,
            'data' => $data,

        ];
        return response()->json($response, $code);
    }
}
