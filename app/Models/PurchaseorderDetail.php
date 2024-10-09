<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseorderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchaseorder_id', 'total_materials', 'iva', 'total',
    ];

    public function purchaseorder()
    {
        return $this->belongsTo(Purchaseorder::class);
    }
}
