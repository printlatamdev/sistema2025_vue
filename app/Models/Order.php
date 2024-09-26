<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'contact_id',
        'delivery_date',
        'user_id',
        'status',
        'computo',
        'print',
        'cut',
        'country_id',
        'payment',
        'mod',
        //'project_id',
        'application_number',
    ];
}
