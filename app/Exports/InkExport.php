<?php

namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class InkExport implements FromQuery
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Material::all();
    }
}
