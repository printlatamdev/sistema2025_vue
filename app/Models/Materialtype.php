<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialtype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'color_id', 'quantity', 'status', 'materialcategory_id', 'description',
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
        return $this->belongsToMany(Color::class)->withPivot('quantity')->withTimestamps();
    }
}
