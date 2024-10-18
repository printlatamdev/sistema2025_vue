<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
                return number_format($this->pivot->price, 2);
            }),
            'image' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->image;
            }),
            'quantity' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->quantity;
            }),
            'subtotal' => $this->whenPivotLoaded('product_quote', function () {
                return number_format($this->pivot->subtotal, 2);
            }),
            'details' => $this->whenPivotLoaded('product_quote', function () {
                return $this->pivot->details;
            }),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
