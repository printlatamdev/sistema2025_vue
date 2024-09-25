<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'status'
    ];

    
    public function material(){
        return $this->hasMany(Material::class);
    }
}
