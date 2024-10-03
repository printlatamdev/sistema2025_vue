<?php

namespace App\Models;

use App\Enums\OrderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'details',
        'ordertype'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }
}
