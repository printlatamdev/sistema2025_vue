<?php

namespace App\Enums;

enum OfferValidityEnum: string
{
    case TenDays = '10 días';
    case FifteenDays = '15 días';
    case ThirtyDays = '30 días';
}
