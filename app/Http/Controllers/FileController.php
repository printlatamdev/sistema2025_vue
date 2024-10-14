<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store($image, $model, $id)
    {
        $name = time().'.'.$image->extension();
        $urlFile = $image->storeAs('files', $name);
        $data = File::create([
            'url' => Storage::url($urlFile),
            'imageable_id' => $id,
            'imageable_type' => $model,
        ]);

        return $data;
    }
}
