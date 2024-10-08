<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'acronym'];

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function image()
    {
        return $this->morphTo(Image::class, 'imageable');
    }
}
