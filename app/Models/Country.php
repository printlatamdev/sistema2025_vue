<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'acronym'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

   /** public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    } */

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }
}
