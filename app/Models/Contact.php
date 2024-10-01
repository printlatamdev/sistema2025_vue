<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'cellphone',
        'telephone',
        'email',
        'company_id',
        'country_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function quote()
    {
        return $this->hasMany(Quote::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
