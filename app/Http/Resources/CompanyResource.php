<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'commercial_name' => $this->commercial_name,
            'social_reason' => $this->social_reason,
            'cellphone' => $this->cellphone,
            'telephone' => $this->telephone,
            'nrc' => $this->nrc,
            'nit' => $this->nit,
            'business_line' => $this->business_line,
            'agency' => $this->agency,
            'address' => $this->address,
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
