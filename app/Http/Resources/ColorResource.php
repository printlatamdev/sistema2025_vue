<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            'hex' => $this->hex,
            'description' => $this->description,
            'code' => $this->whenPivotLoaded('color_materialtype', function () {
                return $this->code;
            }),
            'entry_date' => $this->whenPivotLoaded('color_materialtype', function () {
                return $this->entry_date;
            }),
            'departure_date' => $this->whenPivotLoaded('color_materialtype', function () {
                return $this->departure_date;
            }),
            'use_date' => $this->whenPivotLoaded('color_materialtype', function () {
                return $this->use_date;
            }),
            'expiration_date' => $this->whenPivotLoaded('color_materialtype', function () {
                return $this->expiration_date;
            }),
        ];
    }
}
