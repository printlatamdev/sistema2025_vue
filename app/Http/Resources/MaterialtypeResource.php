<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Carbon\Carbon;
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
            'category' => new MaterialcategoryResource($this->materialcategory),
            'description' => $this->description,
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
