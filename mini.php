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
$new_image = imagecreatetruecolor(350, 517);
setTransparency($new_image, $image_source);
imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, 350, 517, 350, 517);

$fontfile = realpath('fonts/arial.ttf');

$text = trim(mb_strtoupper($tp));
$text = preg_replace('/(' . preg_quote('\N') . ')+/', "\n", $text);
$length = mb_strlen($text, 'UTF-8');

$length2 = mb_strlen(str_replace(' ', '', $text) , 'UTF-8');

if ($length2 > 5 and count(explode(' ', $text)) < 2)
{
    $fontsize = auto_font_size($text, 300, $fontfile);
}
else
{
    $fontsize = maxFontSizeFromWidth($length);
}

$box = new Box($new_image);
$box->setFontFace($fontfile);
$box->setFontColor(new Color(255, 255, 255));
$box->setFontSize($fontsize);
$box->setBox(20, 30, 310, 517);
$box->setTextAlign('left', 'top');
$box->draw($text);

if (!empty(trim($tg)))
{
    // auto font size
    $text = $tg;
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim(mb_strtoupper($text));
    $fontsize = auto_font_size($text, 300, $fontfile);
    $fontsize = ($fontsize < 30) ? $fontsize : 30;

    $box = new Box($new_image);
    $box->setFontFace($fontfile);
    $box->setFontColor(new Color(255, 255, 255));
    $box->setFontSize($fontsize);
    $box->setBox(20, -20, 310, 517);
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
    if ($x < 7) return 95;
    if ($x < 8) return 94;
    if ($x < 9) return 88;
    if ($x < 10) return 82;
    if ($x < 11) return 76;
    if ($x < 12) return 68;
    if ($x < 13) return 62;
    if ($x < 14) return 58;
    if ($x < 15) return 56;
    if ($x < 16) return 53;
    if ($x < 17) return 50;
    if ($x < 18) return 45;
    if ($x < 19) return 43;
    if ($x < 20) return 40;
    if ($x < 21) return 38;
    if ($x < 22) return 37;
    if ($x < 23) return 36;
    if ($x < 24) return 35;
    if ($x < 25) return 34;
    if ($x < 26) return 33;
    if ($x < 27) return 32;
    if ($x < 28) return 31;
    if ($x < 29) return 30;
    if ($x < 30) return 29;
    if ($x < 31) return 28;
    if ($x < 32) return 27;
    if ($x < 33) return 26;
    return 25;
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

