<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->price;
            }),
            'quantity' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->quantity;
            }),
            'total' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->total;
            }),
            'details' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->details;
            }),
        ];
    }
}
