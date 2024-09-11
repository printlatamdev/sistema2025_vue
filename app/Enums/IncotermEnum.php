<?php

namespace App\Enums;

enum IncotermEnum: string
{
    case EXW = 'EXW';
    case FOB = 'FOB';
    case CIF = 'CIF';
    case DAP = 'DAP';
    case DDP = 'DDP';
}
