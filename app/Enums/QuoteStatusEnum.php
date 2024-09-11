<?php

namespace App\Enums;

enum QuoteStatusEnum: string
{
    case Review = 'En revisión';
    case Approved = 'Aprobada';
    case Cancel = 'Cancelada';
}
