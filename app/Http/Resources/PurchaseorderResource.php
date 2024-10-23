<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'materials' => MaterialResource::collection($this->materials),
            'approvedBy' => $this->approvedBy,
            'requestedBy' => $this->requestedBy,
            'total' => number_format($this->total, 2),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
