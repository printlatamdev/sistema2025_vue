<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store($image, $model, $id)
    {
        $name = time().'.'.$image->extension();
        $urlImage = $image->storeAs('images', $name);
        $data = Image::create([
            'url' => Storage::url($urlImage),
            'imageable_id' => $id,
            'imageable_type' => $model,
        ]);

        return $data;
    }

    public function temUpload(Request $request){

    }
}
