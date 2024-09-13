<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // . '-' . Carbon::now()->format('y')
        return [
            'id' => $this->id,
            'important_note' => $this->important_note,
            'payment_condition' => $this->payment_condition,
            'offer_validity' => $this->offer_validity,
            'currency' => $this->currency,
            'status' => $this->status,
            'incoterm' => $this->incoterm,
            'user' => new UserResource($this->user),
            'company' => new CompanyResource($this->company),
            'contact' => new ContactResource($this->contact),
            'products' => ProductResource::collection($this->products)
        ];
    }
}
