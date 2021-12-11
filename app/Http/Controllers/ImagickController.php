<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imagick;
use ImagickPixel;
use ImagickDraw;

class ImagickController extends Controller
{
    public function index()
    {
        /* Чтение изображения */
        $url = 'https://en.meming.world/images/en/thumb/5/5f/Scared_Hamster.jpg/300px-Scared_Hamster.jpg';
        $file = file_get_contents($url);
        $im = new Imagick();
        $im->readImageBlob($file);

        $im->thumbnailImage(200, null);

        $im->borderImage('white', 5, 5);

        $canvas = new Imagick();

        $width = $im->getImageWidth() + 40;
        $height = $im->getImageHeight() + 60;
        $canvas->newImage($width, $height, new ImagickPixel("black"));

        $draw = new ImagickDraw();
        $draw->setFillColor('white');
        $draw->setFont('Arial');
        $draw->setFontSize('16');

        $canvas->annotateImage($draw, ($im->getImageWidth() / 2 - 10), 280, 0, "Хомяк");

        $canvas->setImageFormat("png");

        $canvas->compositeImage($im, imagick::COMPOSITE_OVER, 20, 10);

        header("Content-Type: image/png");
        echo $canvas;
    }
}
