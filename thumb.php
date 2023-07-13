<?php

$size = isset($_GET['size']) ? str_replace(array('<', 'x'), '', $_GET['size']) != '' ? $_GET['size'] : 100 : 100;
list($w,$h) = explode('x', str_replace('<', '', $size) . 'x');
$w = ($w != '') ? floor(max(8, min(1500, $w))) : '';
$h = ($h != '') ? floor(max(8, min(1500, $h))) : '';

/* read the source image */
$sourceName = $_GET["src"];
$source_image = @imagecreatefromjpeg($sourceName);
if ( $source_image === false)
    $source_image = @imagecreatefromgif($sourceName);
if ( $source_image === false)
    $source_image = @imagecreatefrompng($sourceName);

$width = imagesx($source_image);
$height = imagesy($source_image);

$original_aspect = $width / $height;
$thumb_aspect = $w / $h;

if ( $original_aspect >= $thumb_aspect )
{
    // If image is wider than thumbnail (in aspect ratio sense)
    $new_height = $h;
    $new_width = $width / ($height / $h);
}
else
{
    // If the thumbnail is wider than the image
    $new_width = $w;
    $new_height = $height / ($width / $w);
}

$thumb = imagecreatetruecolor( $w, $h );

// Resize and crop
imagecopyresampled($thumb,
    $source_image,
    0 - ($new_width - $w) / 2, // Center the image horizontally
    0 - ($new_height - $h) / 2, // Center the image vertically
    0, 0,
    $new_width, $new_height,
    $width, $height);


// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');

// Output the image
imagejpeg($thumb);