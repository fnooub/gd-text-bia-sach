<?php

$url = isset($_GET['url']) ? $_GET['url'] : exit;
$image = imagecreatefromstring(file_get_contents($url));
if (preg_match('/^.*\.(jpg|jpeg)$/i', $url)) {
	header('Content-Type: image/jpeg');
	imagejpeg($image);
} elseif (preg_match('/^.*\.gif$/i', $url)) {
	header('Content-Type: image/gif');
	imagegif($image);
} elseif (preg_match('/^.*\.png$/i', $url)) {
	header('Content-Type: image/png');
	imagepng($image);
} else {
	exit('die');
}

imagedestroy($image);