<?php

namespace App\Http\Controllers;

use App\Enums\ColorsEnum;
use App\Models\Material;

class BrandController extends Controller
{
    public function testFunction(){
        $colors = ColorsEnum::cases();
        return $colors;
    }
}
