<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseorderResource extends JsonResource
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
            'details' => $this->details,
            'ordertype' => $this->ordertype,
            'provider' => new ProviderResource($this->provider),
            'requested_by' => UserResource::collection($this->users),
            'approved_by' => UserResource::collection($this->users),
        ];
    }
}