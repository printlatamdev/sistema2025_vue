<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            'quantity' => $this->quantity,
            'serie' => $this->serie,
            'ounce' => $this->ounce,
            'thickness' => $this->thickness,
            'measures' => [
                'width' => $this->width,
                'lenght' => $this->lenght,
            ],
            'color' => $this->color,
            'finish' => $this->finish,
            'density' => $this->density,
            'size' => $this->size,
            'gum' => $this->gum,
            'print' => $this->print,
            'inks' => [
                'status' => $this->status,
                'code' => $this->code,
                'entry_date' => $this->entry_date,
                'departure_date' => $this->departure_date,
                'use_date' => $this->use_date,
                'expiration_date' => $this->expiration_date,
            ],
            'brand' => new BrandResource($this->brand),
            'category_id' => new MaterialcategoryResource($this->materialcategory),
            'type' => new MaterialtypeResource($this->materialtype),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'pivot' => [
                'price' => $this->whenPivotLoaded('material_purchaseorder', function () {
                    return $this->pivot->price;
                }),
                'quantity' => $this->whenPivotLoaded('material_purchaseorder', function () {
                    return $this->pivot->quantity;
                }),
                'subtotal' => $this->whenPivotLoaded('material_purchaseorder', function () {
                    return number_format($this->pivot->subtotal, 2);
                }),
                'total' => $this->whenPivotLoaded('material_purchaseorder', function () {
                    return number_format($this->pivot->total, 2);
                }),
                'details' => $this->whenPivotLoaded('material_purchaseorder', function () {
                    return $this->pivot->details;
                }),
            ],
            'activities' => ActivitylogResource::collection($this->whenLoaded('activities')),
        ];
    }
}
