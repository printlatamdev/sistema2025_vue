<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'commercial_name',
        'social_reason',
        'address',
        'cellphone',
        'telephone',
        'nrc',
        'nit',
        'business_line',
        'agency',
    ];

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function quote()
    {
        return $this->hasMany(Quote::class);
    }

    /**public function brand()
    {
        return $this->hasMany(Brand::class);
    } */

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
