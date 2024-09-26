<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status', 'description',
    ];

    public function materialtype()
    {
        return $this->hasMany(Materialtype::class);
    }
}
