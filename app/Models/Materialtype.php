<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialtype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color_id',
        'status',
        'materialcategory_id',
        'description',
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function material()
    {
        return $this->hasMany(Material::class);
    }

    public function materialcategory()
    {
        return $this->belongsTo(Materialcategory::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_materialtype')->withPivot('code', 'entry_date', 'departure_date', 'use_date', 'expiration_date')->withTimestamps();
    }
}
