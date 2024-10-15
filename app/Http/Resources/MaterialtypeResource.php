<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialtypeResource extends JsonResource
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
            'color' => $this->color,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'category' => new MaterialcategoryResource($this->materialcategory),
            'description' => $this->description,
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
