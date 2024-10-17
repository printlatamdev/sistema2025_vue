<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseorderdetailResource extends JsonResource
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
            'total_materials' => number_format($this->total_materials, 2),
            'iva' => number_format($this->iva, 2),
            'total' => number_format($this->total, 2),
            'purchaseorder' => new PurchaseorderResource($this->purchaseorder),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
