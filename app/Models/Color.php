<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'hex', 'description',
    ];

    public function materialtypes()
    {
        return $this->belongsToMany(Materialtype::class, 'color_materialtype')->withPivot('code', 'entry_date', 'departure_date', 'use_date', 'expiration_date')->withTimestamps();
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }
}
