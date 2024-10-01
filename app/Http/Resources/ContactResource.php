<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'company' => new CompanyResource($this->whenLoaded('company')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
