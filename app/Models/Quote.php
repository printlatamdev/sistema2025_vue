<?php

namespace App\Models;

use App\Enums\IncotermEnum;
use App\Enums\OfferValidityEnum;
use App\Enums\PaymentConditionEnum;
use App\Enums\QuoteStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'contact_id',
        'payment_condition',
        'offer_validity',
        'currency',
        'status',
        'incoterm',
        'important_note',
    ];

    protected $casts = [
        'status' => QuoteStatusEnum::class,
        'incoterm' => IncotermEnum::class,
        'payment_condition' => PaymentConditionEnum::class,
        'offer_validity' => OfferValidityEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function quotedetails()
    {
        return $this->hasOne(Quotedetail::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity', 'total', 'details');
    }
}
