<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'details',
        'ordertype',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_purchaseorder')->withPivot('price', 'quantity', 'subtotal', 'total', 'details')->orderByPivot('id', 'desc');
    }
}
