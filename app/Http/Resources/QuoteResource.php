<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'important_note' => $this->important_note,
            'payment_condition' => $this->payment_condition,
            'offer_validity' => $this->offer_validity,
            'currency' => $this->currency,
            'status' => $this->status,
            'incoterm' => $this->incoterm,
            'user' => UserResource::collection($this->user),
            'company' => CompanyResource::collection($this->company),
            'contact' => ContactResource::collection($this->contact),
        ];
    }
}
