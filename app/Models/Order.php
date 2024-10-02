<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'computo',
        'print',
        'cut',
        'payment',
        'mod',
        'application_number',
        'delivery_date',
        'application_date',
        'assign_date',
        'next_payment_date',
        'country_id',
        'user_id',
        'company_id',
        'contact_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_order')->withPivot('price', 'quantity', 'subtotal', 'total', 'details')->orderByPivot('id', 'desc');
    }
}
