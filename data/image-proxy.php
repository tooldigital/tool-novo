<?php

$quality = 75;
$width = 250;
$height = 675;

$stripsFolder = '../assets/strips/';

$imagePath = $_GET["p"];

if(strrpos($imagePath, "http://toolofna.com") != 0) {
	echo "Error: URL provided is illegal. Needs to start with http:// and point to an image in toolofna.com domain";
	quit();
}

$urlElements = explode("/", $imagePath);
$lastElementIndex = count($urlElements) - 1;

$fileName = $urlElements[$lastElementIndex];

if(file_exists($stripsFolder . $fileName)) {
	header('Content-type: image/jpeg');
	readfile($stripsFolder . $fileName);
} else {
	$im = imagecreatefromjpeg($imagePath);
	$sm = imagecreatetruecolor($width, $height);
	imagecopyresampled($sm, $im, 0, 0, 0, 0, 300, 810, 400, 1080);

	imagejpeg($sm, $stripsFolder . $fileName, $quality);

	header('Content-type: image/jpeg');
	imagejpeg($sm, NULL, $quality);
}

?>