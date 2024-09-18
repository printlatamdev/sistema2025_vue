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

    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'product_quote')->withPivot('price', 'quantity', 'total', 'details', 'image')->orderByPivot('id', 'desc');
    }
}
