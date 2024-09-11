<?php

namespace App\Enums;

enum PaymentConditionEnum: string
{
    case Advance = 'Anticipo';
    case TotalAdvancePayment = 'Pago total anticipado';
    case PaymentUponDelivery = 'Pago contra entrega';
    case PaymentIn30Days = 'Pago a 30 días';
    case PaymentIn60Days = 'Pago a 60 días';
}
