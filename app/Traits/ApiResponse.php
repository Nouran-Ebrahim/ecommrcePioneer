<?php

namespace App\Traits;
use App\Http\Resources\PaginationResource;
use Illuminate\Pagination\LengthAwarePaginator;
trait ApiResponse
{
    protected function apiResponse(
        $data = null,
        string $msg = '',
        bool $status = true,
        int $code = 200,
        $pagination = null
    ) {

        $response = [
            'status' => $status,
            'message' => $msg,
            'data' => $data,

        ];
        // لو فيه Pagination
        if ($pagination instanceof LengthAwarePaginator) {
            $response['pagination'] = new PaginationResource($pagination);
        }
        return response()->json($response, $code);
    }
}
