<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'profile_photo_url' => $this->profile_photo_url,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->roles),
            'countries' => CountryResource::collection($this->whenLoaded('countries')),
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
