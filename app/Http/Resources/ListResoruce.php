<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResoruce extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }
    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data' => [
                'from' => $this->resource->firstItem(),
                'last_page' => $this->resource->lastPage(),
                'next_page_url' => $this->resource->nextPageUrl(),
                'per_page' => $this->resource->perPage(),
                'prev_page_url' => $this->resource->previousPageUrl(),
                'total' => $this->resource->total(),
                'data' => $this->resource->items()
            ]
        ];
    }
}
