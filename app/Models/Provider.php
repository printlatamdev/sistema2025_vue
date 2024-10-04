<?php

namespace App\Models;

use App\Enums\PaymentConditionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'payment_condition',
    ];

    protected $casts = [
        'payment_condition' => PaymentConditionEnum::class,
    ];

    public function purchaseorder()
    {
        return $this->hasOne(Purchaseorder::class);
    }
}
