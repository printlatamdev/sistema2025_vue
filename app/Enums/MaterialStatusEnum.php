<?php

namespace App\Enums;

enum MaterialStatusEnum: string
{
    case Finished = 'Finalizada';
    case Production = 'Producción';
    case Warehouse = 'Bodega';
    case Discarded = 'Descartado';
}
