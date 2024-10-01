<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'computo' => $this->computo,
            'print' => $this->print,
            'cut' => $this->cut,
            'payment' => $this->payment,
            'mod' => $this->mod,
            'application_number' => $this->application_number,
            'delivery_date' => $this->delivery_date,
            'application_date' => $this->application_date,
            'assign_date' => $this->assign_date,
            'next_payment_date' => $this->next_payment_date,
            'country' => $this->country,
            'user' => $this->user,
            'company' => $this->company,
            'contact' => $this->contact,
            'register_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
