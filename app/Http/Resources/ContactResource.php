<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'lastname' => $this->lastname,
            'cellphone' => $this->cellphone,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'company' => CompanyResource::collection($this->company),
            'country' => CountryResource::collection($this->country),
        ];
    }
}
