<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotedetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'total',
        'details',
    ];
    
    public function product()
    {
        return $this->belongsTo(Quote::class);
    }

    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'quote_quotedetail')->withPivot('iva', 'subtotal');
    }
    
   /** public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    } */
}
