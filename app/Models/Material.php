<?php

namespace App\Models;

use App\Enums\ColorsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Material extends Model
{
    use HasFactory;
    //use LogsActivity;

    protected $fillable = [
        'name',
        'quantity',
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
        'status',
        'code',
        'entry_date',
        'departure_date',
        'use_date',
        'expiration_date',
        'brand_id',
        'materialtype_id',
    ];

    protected $cast = [
        'color' => ColorsEnum::class,
    ];

    public function materialtype()
    {
        return $this->belongsTo(Materialtype::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'material_order')->withPivot('price', 'quantity', 'subtotal', 'total', 'details')->orderByPivot('id', 'desc');
    }

   /* public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name'])
        ->logOnlyDirty();
    }*/
}
