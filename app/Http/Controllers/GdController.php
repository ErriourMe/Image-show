<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GdController extends Controller
{
    public function index() {
        header('Content-Type: image/png');

        $homyak = 'https://en.meming.world/images/en/thumb/5/5f/Scared_Hamster.jpg/300px-Scared_Hamster.jpg';

        $gd = imagecreatetruecolor(1000, 1000);
        $realJpg = imagecreatefromjpeg($homyak);
        $realJpgSize = getimagesize($homyak);

        $colorWhite = imageColorAllocate($gd, 255, 255, 255);
        $colorBlack = imageColorAllocate($gd, 0, 0, 0);

        $colorYellow = imageColorAllocateAlpha($gd, 255, 255, 0, 60);
        $colorRed = imageColorAllocate($gd, 233, 14, 91);
        $font = public_path('arial.ttf');

        // for ($i = 0; $i < 1000; $i++)
        // {
        //     $x = rand(1, 1000);
        //     $y = rand(1, 1000);

        //     imagesetpixel($gd, round($x),round($y), $colorWhite);
        // }

        // imageFilledRectangle($gd, 250, 250, 750, 750, $colorYellow);
        // imageEllipse($gd, 750, 280, 300, 200, $colorRed);

        // imagettftext($gd, 20, 0, 280, 300, $colorRed, $font, "Какой-то текст");

        // imagesetthickness($gd, 4);
        // imageline($gd, 100, 200, 800, 1000, $colorBlack);

        // imageflip($realJpg, IMG_FLIP_HORIZONTAL);

        // $newWidth = 700;
        // $newHeight = 500;
        // $newRealJpg = imagecreatetruecolor($newWidth, $newHeight);
        // imagecopyresized($newRealJpg, $realJpg, 0, 0, 0, 0, $newWidth, $newHeight, $realJpgSize[0], $realJpgSize[1]);

        // // imagecopymerge($gd, $realJpg, 400, 400, 0, 0, $realJpgSize[0], $realJpgSize[1], 30);
        // imagecopymerge($gd, $newRealJpg, 400, 400, 0, 0, $newWidth, $newHeight, 100);

        imagepng($gd);
        imagedestroy($gd);
    }
}
