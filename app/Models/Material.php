<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'serie',
        'ounce',
        'thickness',
        'width',
        'lenght',
        'color',
        'finish',
        'density',
        'size',
        'gum',
        'print',
        'category_id',
        'type_id',
    ];

    public function materialcategory()
    {
        return $this->belongsTo(Materialcategory::class);
    }

    public function materialtype()
    {
        return $this->belongsTo(Materialtype::class);
    }
}
