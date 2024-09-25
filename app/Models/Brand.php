<?php

namespace App\Models;

use App\Enums\BrandCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'description'
    ];

    protected $casts = [
        'category' => BrandCategoryEnum::class,
    ];

    public function material(){
        return $this->hasMany(Material::class);
    }
}
