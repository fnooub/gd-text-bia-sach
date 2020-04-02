<?php
/**
* Class and Function List:
* Function list:
* - auto_font_size()
* - setTransparency()
* - maxFontSizeFromWidth()
* - maxWidthFromFontSize()
* Classes list:
*/
require __DIR__ . '/vendor/autoload.php';

use GDText\Box;
use GDText\Color;

// GET
$tp = $_GET['tp']??'Tên tác phẩm cuốn sách';
$tg = $_GET['tg']??'Tên tác giả cuốn sách';

$image_source = imagecreatefrompng('cover.png');
$new_image = imagecreatetruecolor(500, 739);
setTransparency($new_image, $image_source);
imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, 500, 739, 500, 739);

$fontfile = realpath('fonts/arial.ttf');

$text = trim(mb_strtoupper($tp));
$text = preg_replace('/(' . preg_quote('\N') . ')+/', "\n", $text);
$length = mb_strlen($text, 'UTF-8');
$fontsize = maxFontSizeFromWidth($length);

$box = new Box($new_image);
$box->setFontFace($fontfile);
$box->setFontColor(new Color(255, 255, 255));
$box->setFontSize($fontsize);
$box->setLineHeight(1.2);
$box->setBox(30, 40, 440, 739);
$box->setTextAlign('left', 'top');
$box->draw($text);

if (!empty(trim($tg)))
{
    // auto font size
    $text = $tg;
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim(mb_strtoupper($text));
    $fontsize = auto_font_size($text, 420, $fontfile);
    $fontsize = ($fontsize < 35) ? $fontsize : 35;

    $box = new Box($new_image);
    $box->setFontFace($fontfile);
    $box->setFontColor(new Color(255, 255, 255));
    $box->setFontSize($fontsize);
    $box->setBox(30, -25, 440, 739);
    $box->setTextAlign('right', 'bottom');
    $box->draw($text);
}

header("Content-type: image/png");
imagepng($new_image);
imagedestroy($new_image);

function auto_font_size($text, $text_maxwidth, $fontfile, $fontsize = 1)
{
    do
    {
        $fontsize++;
        $bbox = imagettfbbox($fontsize, 0, $fontfile, $text);
        $text_width = $bbox[2] - $bbox[0];
        // $txt_height = $bbox[1] - $bbox[7]; // just in case you need it
        
    }
    while ($text_width <= $text_maxwidth);
    return $fontsize;
}

function setTransparency($new_image, $image_source)
{

    $transparencyIndex = imagecolortransparent($image_source);
    $transparencyColor = array(
        'red' => rand(1, 255) ,
        'green' => rand(1, 255) ,
        'blue' => rand(1, 255)
    );

    if ($transparencyIndex >= 0)
    {
        $transparencyColor = imagecolorsforindex($image_source, $transparencyIndex);
    }

    $transparencyIndex = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
    imagefill($new_image, 0, 0, $transparencyIndex);
    imagecolortransparent($new_image, $transparencyIndex);

}
function maxFontSizeFromWidth($x)
{
    if ($x < 7) return 96;
    if ($x < 8) return 94;
    if ($x < 9) return 92;
    if ($x < 10) return 90;
    if ($x < 11) return 88;
    if ($x < 12) return 84;
    if ($x < 13) return 82;
    if ($x < 14) return 80;
    if ($x < 15) return 78;
    if ($x < 16) return 76;
    if ($x < 17) return 74;
    if ($x < 18) return 72;
    if ($x < 19) return 70;
    if ($x < 20) return 68;
    if ($x < 21) return 66;
    if ($x < 22) return 64;
    if ($x < 23) return 62;
    if ($x < 24) return 60;
    if ($x < 25) return 58;
    if ($x < 26) return 56;
    if ($x < 27) return 54;
    if ($x < 28) return 52;
    if ($x < 29) return 50;
    if ($x < 30) return 48;
    if ($x < 31) return 46;
    if ($x < 32) return 44;
    if ($x < 33) return 42;
    return 40;
}
function maxWidthFromFontSize($x)
{
    if ($x < 22) return 37;
    if ($x < 24) return 36;
    if ($x < 25) return 35;
    if ($x < 28) return 32;
    if ($x < 29) return 30;
    if ($x < 31) return 29;
    if ($x < 34) return 26;
    if ($x < 35) return 25;
    if ($x < 37) return 24;
    if ($x < 39) return 23;
    if ($x < 44) return 19;
    if ($x < 45) return 18;
    if ($x < 51) return 16;
    if ($x < 53) return 15;
    if ($x < 54) return 14;
    if ($x < 62) return 13;
    if ($x < 63) return 12;
    if ($x < 77) return 11;
    if ($x < 92) return 9;
    if ($x < 100) return 8;
    return 7;
}

