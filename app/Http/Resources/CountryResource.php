<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'acronym' => $this->acronym,
            'image' => new ImageResource($this->image),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
