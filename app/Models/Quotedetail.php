<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotedetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'total_products',
        'iva',
        'total',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
