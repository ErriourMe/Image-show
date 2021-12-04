<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    // https://jpgraph.net/
    // Zebra Image, Imagine, Intervention Image
    // http://image.intervention.io/
    public function index(InterventionRequest $request)
    {
        $file = Image::make($request->link);

        $mimes = [
            'webp' => 'image/webp',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
        ];

        $multiplierWidth = $request->width ? $file->width() / $request->width : 1;
        $multiplierHeight = $request->height ? $file->height() / $request->height : 1;


        $extension = $request->extension ?? 'jpg'; // $file->extension();
        $mime = $file->mime(); // $file->getMimeType();

        if(!($request->width === null && $request->height === null)) {
            $file = $file->fit($request->width, $request->height, function ($constraint) {
                $constraint->aspectRatio();
                // $constraint->upsize();
            });
        }

        if($request->watermark) {
            $watermark = Image::make('https://www.pngkey.com/png/full/109-1090674_php-logo-png-php-logo-png-white.png');
            $watermark->resize(150 / $multiplierWidth, 150 / $multiplierHeight, function($constraint) {
                $constraint->aspectRatio();
            });
            $watermark->opacity(80);
            $file->insert($watermark, 'bottom-right', 20, 20);
        }

        if(in_array($extension, ['jpg', 'png', 'webp'])) {
            $mime = $mimes[$extension];
        }

        $file = $file->encode($mime, $request->quality ?? 75);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $mime);
        $response->header("Cache-control", 'max-age=' . (60 * 60 * 24 * 365));
        $response->header("Expires", gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));

        return $response;
    }
}
