<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;


class ImagesController extends Controller
{
    public function getImage($fileName)
    {
        $projectDetails = null;
    
        $patch = public_path(). '/uploads/' .$fileName;
        
        return response()->download($patch);
    }
}
