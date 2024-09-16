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
            'quote' => new QuoteResource($this->quote),
            'total_products' => $this->total_products,
            'iva' => $this->iva,
            'total' => $this->total,
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
