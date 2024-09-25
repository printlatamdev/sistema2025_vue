<?php

namespace App\Http\Resources;

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
            'serie' => $this->serie,
            'ounce' => $this->ounce,
            'thickness' => $this->thickness,
            'width' => $this->width,
            'lenght' => $this->lenght,
            'color' => $this->color,
            'finish' => $this->finish,
            'density' => $this->density,
            'size' => $this->size,
            'gum' => $this->gum,
            'print' => $this->print,
            //Tintas
            'status' => $this->status,
            'code' => $this->code,
            'dates' => [
                'entry_date' => $this->entry_date,
                'departure_date' => $this->departure_date,
                'use_date' => $this->use_date,
                'expiration_date' => $this->expiration_date,
            ],
            'brand_id' => BrandResource::collection($this->$this->brand),
            'category_id' => MaterialcategoryResource::collection($this->materialcategory),
            'type_id' => MaterialtypeResource::collection($this->materialtype),
        ];
    }
}
