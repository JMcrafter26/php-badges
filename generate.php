<?php

/**
 * Generate a badge image using PHP GD
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 * Version: 1.0.2 
 * (c) 2023 JM26.NET
 */

/*-------------------------------------------------------*/
/*This version is not finished! Please check for updates!*/
/*-------------------------------------------------------*/


/* Setting the default values for the badge. */
$label = 'Documentation:';
$message = 'go.jm26.net/badge-docs';
$labelColor = '#555555';
$messageColor = '#97CA00';
$roundedCorner = 5; // This does not work yet :(

/* This is checking if the label and message are set. If they are, it will set the label and message to
the value of the label and message. */
if (isset($_GET['label'])) {
    $label = $_GET['label'];
}
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}


//Set default colors, like shields.io
$color_brightgreen = '#44cc11';
$color_green = '#97CA00';
$color_yellowgreen = '#a4a61d';
$color_yellow = '#dfb317';
$color_orange = '#fe7d37';
$color_red = '#e05d44';
$color_lightgrey = '#9f9f9f';
$color_blue = '#007ec6';
$color_violet = '#7b16ff';
$color_grey = '#555555';
$color_silver = '#9f9f9f';
$color_success = '#44cc11';
$color_important = '#fe7d37';
$color_critical = '#e05d44';
$color_informational = '#007ec6';
$color_inactive = '#9f9f9f';


/* Checking if the color is set and if it is not empty. If it is, it will check if it is in hex format.
If it is, it will set the message color to the color. If it is not, it will set the message color to
the color. If the color is not set or is empty, it will set the message color to the default color. */
if (isset($_GET['color']) && $_GET['color'] != '') {
    //if is in hex format like #ffffff
    if (preg_match('/^#[a-f0-9]{6}$/i', $_GET['color'])) {
        $messageColor = $_GET['color'];
    } else {
        $messageColor = ${'color_' . $_GET['color']};
        if ($messageColor == '') {
            $messageColor = '#44cc11'; //default to brightgreen
        }
    }
}

/* This is setting the font, font color, and the size of the badge. */
$font = './DejaVuSans.ttf'; //https://dejavu-fonts.github.io/
$fontColor = '#ffffff';
$bbox = imagettfbbox(9, 0, $font, $label);
$labelWidth = $bbox[2] - $bbox[0];
$labelWidth += 5;
$bbox = imagettfbbox(9, 0, $font, $message);
$messageWidth = $bbox[2] - $bbox[0];
$imWidth = $labelWidth + $messageWidth + 15;
$imHeight = 20;


/* Creating a new image with the width and height of the badge. */
$im = imagecreatetruecolor($imWidth, $imHeight);

/* Setting the color of the badge. */
$labelColorackground = imagecolorallocate($im, 255, 255, 255);
$colorText = imagecolorallocate($im, hexdec(substr($fontColor, 1, 2)), hexdec(substr($fontColor, 3, 2)), hexdec(substr($fontColor, 5, 2)));
$messageColor = imagecolorallocate($im, hexdec(substr($messageColor, 1, 2)), hexdec(substr($messageColor, 3, 2)), hexdec(substr($messageColor, 5, 2)));
$labelColor = imagecolorallocate($im, hexdec(substr($labelColor, 1, 2)), hexdec(substr($labelColor, 3, 2)), hexdec(substr($labelColor, 5, 2)));


/* Creating the badge. */
imagefilledrectangle($im, 0, 0, $imWidth, $imHeight, $messageColor);
imagefilledrectangle($im, 0, 0, $labelWidth + 5, $imHeight, $labelColor);




/* Creating the text on the badge. */
$bbox = imagettfbbox(9, 0, $font, $label);
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, 9, 0, 5, 14, $colorText, $font, $label);

$bbox = imagettfbbox(9, 0, $font, $message);
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, 9, 0, $labelWidth + 10, 14, $colorText, $font, $message);


/* Setting the content type to image/png and then outputting the image. */
header('Content-Type: image/png');
imagepng($im);

/* Destroying the image. (This is not needed, but it is good practice.) */
imagedestroy($im);

// ---Statistics---
// Please do not remove or change this code. It is used to count the number of times a badge has been generated.
// No personal data is stored.
$statistics = true; // Counts the number of times a badge has been generated. No personal data is stored.
if ($statistics) {
    $statisticsUrl = 'https://test.jm26.net/api/badge/statistics.php?exp=' . md5('statistics' . date('h-i-d-m-Y'));
    $statistics = file_get_contents($statisticsUrl);
}
