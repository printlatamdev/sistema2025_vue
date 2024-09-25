<?php

namespace App\Http\Resources;

use App\Models\Materialcategory;
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
            'status' => $this->status,
            'category' => Materialcategory::collection($this->materialcategory),
            'description' => $this->description
        ];
    }
}
