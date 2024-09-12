<?php

namespace App\Http\Resources;

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
            'quote' => QuoteResource::collection($this->quote),
            'product' => ProductResource::collection($this->product),
            'quantity' => $this->quantity,
            'iva' => $this->iva,
            'price' => $this->price,
            'subtotal' => $this->subtotal,
            'details' => $this->details,
        ];
    }
}
