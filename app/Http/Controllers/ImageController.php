<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $file = Image::make('https://cherepah.ru/wp-content/uploads/3/8/8/3882c14363d51882ab239e032fde224a.jpeg');

        if(!($request->width === null && $request->height === null)) {
            $file = $file->fit($request->width, $request->height, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
        }

        $mime = $file->mime();

        $file = $file->encode($mime, 100);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $mime);
        $response->header("Cache-control", 'max-age=' . (60 * 60 * 24 * 365));
        $response->header("Expires", gmdate(DATE_RFC1123,time() + 60 * 60 * 24 * 365));

        return $response;
    }
}
