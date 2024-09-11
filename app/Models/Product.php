<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

   /** public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    } */

    public function quotedetail()
    {
        return $this->hasMany(Quotedetail::class);
    }
}
