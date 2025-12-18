<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $collects = ProductResource::class;
    // toArray() with ResourceCollection i will use them if did not use collect porbirty with base collection
    // public function toArray(Request $request): array
    // {
    //     return [
    //         'items' => ProductResource::collection($this->collection),
    //         //for custom data like pagination or products count
    //         'current_page' => $this->currentPage(),
    //         'last_page' => $this->lastPage(),
    //         'per_page' => $this->perPage(),
    //         'total' => $this->total(),
    //         'from' => $this->firstItem(),
    //         'to' => $this->lastItem(),
    //         'has_more' => $this->hasMorePages(),
    //         'next_page_url' => $this->nextPageUrl(),
    //         'prev_page_url' => $this->previousPageUrl(),

    //     ];
    // }
}
