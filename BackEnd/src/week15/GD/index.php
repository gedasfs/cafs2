<?php

// $text = $_GET['text'] ?? 'Hello World';
 
// $image = imageCreate(300,75);

// $color = imageColorAllocate($image, 200,200,200);
// $colorBlue = imageColorAllocate($image, 0,0,255);

// imageString($image, 2, 30, 30, $text, $colorBlue);

// header('Content-type: image/jpeg');
// imageJpeg($image);

// imageDestroy($image);

$image = imagecreatefrompng('images/img1.png');

$originColor = imagecolorsforindex($image, imagecolorat($image, 256, 1));
$darkRed = imagecolorallocate($image, 100, 0, 30);

list($width, $height, $type, $attr) = getimagesize('./images/img1.png');

for ($x = 0; $x <= $width - 1; $x++) {
    for ($y = 0; $y <= $height - 1; $y++) {
        $indexColor = imagecolorsforindex($image, imagecolorat($image, $x, $y));

        if ($indexColor == $originColor) {
            imagesetpixel($image, $x, $y, $darkRed);
        }
    }
}

header('Content-type: image/jpeg');
imagepng($image);
imagedestroy($mage);