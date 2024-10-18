<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotedetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quote' => new QuoteResource($this->whenLoaded('quote')),
            'total_products' => number_format($this->total_products, 2),
            'iva' => number_format($this->iva, 2),
            'total' => number_format($this->total, 2),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
