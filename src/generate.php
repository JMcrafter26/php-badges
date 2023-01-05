<?php

/**
 * Generate a badge image using PHP GD
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 */ $Version = '1.1.2'; /*
 * (c) 2023 JM26.NET
 */

/*-----------------------------------------------------------------------*/
/* Do you downloaded DejaVuSans.ttf? If not, download it to this folder. */
/*-----------------------------------------------------------------------*/


/* Usage: https://test.jm26.net/api/badge?label=Label&message=Message&color=Color&fontcolor=FontColor&format=Format
Parameters:
* label: The text that will be displayed on the left side of the badge.
* message: The text that will be displayed on the right side of the badge.
* color: The color of the right side of the badge. (hex, brightgreen, green, yellowgreen, yellow, orange, red, lightgrey, cyan, blue, violet, grey, silver, success, important, critical, informational, inactive, highlight)
* fontcolor: The color of the text on the badge. (hex, brightgreen, green, yellowgreen, yellow, orange, red, lightgrey, cyan, blue, violet, grey, silver, success, important, critical, informational, inactive, highlight)
* format: The format of the image. (png, jpg, gif)
* autofontcolor: If this is set to true, the font color will be set to white if the background color is dark and black if the background color is light.
*/



/* Setting the default values for the badge. */
$label = 'Documentation:';
$message = 'go.jm26.net/badge-docs';
$labelColor = '#555555';
$messageColor = '#97CA00';
$colorText = '#ffffff';
$imageFormat = 'png'; // Default image format (png, jpg, gif)
$chacheLife = 5; // Default cache life (in seconds)
$roundedCorner = 5; // This does not work yet :(

/* This is checking if the label and message are set. If they are, it will set the label and message to
the value of the label and message. */
if (isset($_GET['label'])) {
    $label = $_GET['label'];
}
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
if (isset($_GET['format'])) {
    $imageFormat = $_GET['format'];
    $imageFormat = strtolower($imageFormat);

}

//Set default colors, like shields.io
$color_brightgreen = '#44cc11';
$color_green = '#97CA00';
$color_yellowgreen = '#a4a61d';
$color_yellow = '#dfb317';
$color_orange = '#fe7d37';
$color_red = '#e05d44';
$color_lightgrey = '#9f9f9f';
$color_cyan = '#00eaff';
$color_blue = '#007ec6';
$color_violet = '#7b16ff';
$color_grey = '#555555';
$color_silver = '#9f9f9f';
$color_success = '#44cc11';
$color_important = '#fe7d37';
$color_critical = '#e05d44';
$color_informational = '#007ec6';
$color_inactive = '#9f9f9f';
$color_highlight = '#dbe300';


/* Checking if the color is set and if it is not empty. If it is, it will check if it is in hex format.
If it is, it will set the message color to the color. If it is not, it will set the message color to
the color. If the color is not set or is empty, it will set the message color to the default color. */
if (isset($_GET['color']) && $_GET['color'] != '') {
    //lowercase color
    $_GET['color'] = strtolower($_GET['color']);

        $messageColor = ${'color_' . $_GET['color']};
        if ($messageColor == '') {
            if (preg_match('/^[a-f 0-9]{6}$/i', $_GET['color'])) {
                $messageColor = $_GET['color'];
                    $messageColor = '#' . $messageColor;
                
            } else {
                $messageColor = '#e05d44';
        }
    }
}

if (isset($_GET['fontcolor']) && $_GET['fontcolor'] != '') {
    //lowercase color
    $_GET['fontcolor'] = strtolower($_GET['fontcolor']);

        $colorText = ${'color_' . $_GET['fontcolor']};
        if ($colorText == '') {
            if (preg_match('/^[a-f 0-9]{6}$/i', $_GET['fontcolor'])) {
                $colorText = $_GET['fontcolor'];
                    $colorText = '#' . $colorText;
                
            } else {
                $colorText = '#ffffff';
        }
    }
}

/* This is setting the font, font color, and the size of the badge. */
$font = './DejaVuSans.ttf';
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
$colorText = imagecolorallocate($im, hexdec(substr($colorText, 1, 2)), hexdec(substr($colorText, 3, 2)), hexdec(substr($colorText, 5, 2)));
$messageColorHex = $messageColor;
$messageColor = imagecolorallocate($im, hexdec(substr($messageColor, 1, 2)), hexdec(substr($messageColor, 3, 2)), hexdec(substr($messageColor, 5, 2)));
$labelColor = imagecolorallocate($im, hexdec(substr($labelColor, 1, 2)), hexdec(substr($labelColor, 3, 2)), hexdec(substr($labelColor, 5, 2)));


/* Creating the badge. */
imagefilledrectangle($im, 0, 0, $imWidth, $imHeight, $messageColor);
imagefilledrectangle($im, 0, 0, $labelWidth + 5, $imHeight, $labelColor);



/* Creating the text on the badge. */
$bbox = imagettfbbox(9, 0, $font, $label);
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, 9, 0, 5, 14, $colorText, $font, $label);

if($_GET['autofontcolor'] != true and $_GET['fontcolor'] == '') {
$brightness = (hexdec(substr($messageColorHex, 1, 2)) * 0.299) + (hexdec(substr($messageColorHex, 3, 2)) * 0.587) + (hexdec(substr($messageColorHex, 5, 2)) * 0.114);
if ($brightness > 165) {
    $colorText = imagecolorallocate($im, 0, 0, 0);
} else {
    $colorText = imagecolorallocate($im, 255, 255, 255);
}
}


$bbox = imagettfbbox(9, 0, $font, $message);
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, 9, 0, $labelWidth + 10, 14, $colorText, $font, $message);

/* Setting the cache life. */
header('Cache-Control: max-age=' . $chacheLife . ', public');

/* Setting the content type to image/png and then outputting the image. */
if($imageFormat == 'png') {
    header('Content-Type: image/png');
    imagepng($im);
} elseif($imageFormat == 'jpg') {
    header('Content-Type: image/jpg');
    imagejpeg($im);
} elseif($imageFormat == 'gif') {
    header('Content-Type: image/gif');
    imagegif($im);
} else {
    header('Content-Type: image/png');
    imagepng($im);
}

/* Destroying the image. (This is not needed, but it is good practice.) */
imagedestroy($im);



// ---Statistics & Update Reminder---
// Please do not remove or change this code. It is used to count the number of times a badge has been generated and to remind you to update PHP Badges.
// No personal data is stored.
$statistics = true; // Counts the number of times a badge has been generated. No personal data is stored.
if ($statistics) {
    $statisticsUrl = 'https://test.jm26.net/api/badge/statistics.php?exp=' . md5('statistics' . date('h-i-d-m-Y')) . '&v=' . $Version;
    $statistics = file_get_contents($statisticsUrl);
    if($statistics == 'update' && file_exists('./PLEASE-UPDATE-PHP-BADGES.txt') == false) {
        $file = fopen('./PLEASE-UPDATE-PHP-BADGES.txt', 'w');
        fwrite($file, 'A new version is available. Please update PHP Badges to the latest version. \r You can download the latest version at https://github.com/JMcrafter26/php-badges/releases/latest');
        fclose($file);
    }elseif(file_exists('./PLEASE-UPDATE-PHP-BADGES.txt') == true) {
        // Delete the file if the version is up to date.
        unlink('./PLEASE-UPDATE-PHP-BADGES.txt');
    }
}