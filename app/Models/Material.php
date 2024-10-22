<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Material extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'quantity',
        'serie',
        'ounce',
        'thickness',
        'width',
        'lenght',
        'finish',
        'density',
        'size',
        'gum',
        'print',
        'color_id',
        'brand_id',
        'materialtype_id',
    ];

    public function materialtype()
    {
        return $this->belongsTo(Materialtype::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function purchaseorders()
    {
        return $this->belongsToMany(Purchaseorder::class, 'material_purchaseorder')->withPivot('price', 'quantity', 'subtotal', 'details')->orderByPivot('id', 'desc');
    }

    public function files()
    {
        return $this->morphedByMany(File::class, 'fileable');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'quantity', 'width', 'lenght', 'materialtype_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
