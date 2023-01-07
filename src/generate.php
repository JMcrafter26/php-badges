<?php

/**
 * Generate a badge image using PHP GD
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 */ $Version = '1.1.3'; /*
 * (c) 2023 JM26.NET
 */

/*-----------------------------------------------------------------------*/
/* Do you downloaded DejaVuSans.ttf? If not, download it to this folder. */
/*-----------------------------------------------------------------------*/


/* 
Parameters:
* label: The text that will be displayed on the left side of the badge.
* message: The text that will be displayed on the right side of the badge.
* color: The color of the right side of the badge. (hex, brightgreen, green, yellowgreen, yellow, orange, red, lightgrey, cyan, blue, violet, grey, silver, success, important, critical, informational, inactive, highlight)
* fontcolor: The color of the text on the badge. (hex, brightgreen, green, yellowgreen, yellow, orange, red, lightgrey, cyan, blue, violet, grey, silver, success, important, critical, informational, inactive, highlight)
* format: The format of the image. (png, jpg, gif)
* autofontcolor: If this is set to true, the font color will be set to white if the background color is dark and black if the background color is light.
*/



/*------------------SETTINGS--------------------*/
/*   Edit the settings below to change the      */
/*      default settings of the badge.          */
/*------------------SETTINGS--------------------*/

// Maintenance mode
$maintenace = false; // If this is set to true, the generator will display a maintenance badge.
$maintenacePassword = 'password'; // The password for the maintenance badge.
// Default text
$label = 'Documentation:';
$message = 'go.jm26.net/badge-docs';
// Default colors
$labelColor = '#555555';
$messageColor = '#97CA00';
$colorText = '#ffffff';
$autoFontColor = true;
// Advanced settings
$imageFormat = 'png'; // Default image format (png, jpg, gif)
$chacheLife = 5; // Default cache life (in seconds)
$scale = 20; //Image scale (Higher = Better quality, but bigger file size.)
$resizeOutput = false; //Downscale the output image to the original size. (!Reduces quality!)
$font = './DejaVuSans.woff'; // Download from https://dejavu-fonts.github.io


/*----------------------------------------------*/
/* Do not edit anything below this line unless  */
/*      you know what you are doing!            */
/*----------------------------------------------*/

//Check if the maintenance mode is enabled
if($maintenace == true && $_GET['password'] != $maintenacePassword) {
        header('Content-Type: image/png');
        readfile('https://i.imgur.com/iR3RI3Q.png'); // Download this image from https://test.jm26.net/api/badge/notice.png if imgur took it down.
        header('HTTP/1.0 503 Service Unavailable');
        die();
}

/* This is checking if the label and message are set. If they are, it will set the label and message to
the value of the label and message. */
if (isset($_GET['label'])) {
    $label = $_GET['label'];
    $label = htmlspecialchars($label);
}
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $message = htmlspecialchars($message);

}
if (isset($_GET['format'])) {
    $imageFormat = $_GET['format'];
    $imageFormat = strtolower($imageFormat);
}
if (isset($_GET['scale'])) {
    $scale = $_GET['scale'];
    if (!is_numeric($scale) || $scale > 100) {
        $scale = 20;
    }
}
if (isset($_GET['resizeoutput'])) {
    if ($_GET['resizeoutput'] == 'true') {
        $resizeOutput = true;
    } else {
        $resizeOutput = false;
    }
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
$color_pink = '#ff69b4';
$color_grey = '#555555';
$color_silver = '#9f9f9f';
$color_success = '#44cc11';
$color_ok = '#97CA00';
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

// auto font color
if ($_GET['autofontcolor'] == 'false') {
    $autoFontColor = false;
} elseif ($_GET['autofontcolor'] == 'true') {
    $autoFontColor = true;
}

/* This is setting the font, font color, and the size of the badge. */
$bbox = imagettfbbox((9 * $scale), 0, $font, $label); //b
$labelWidth = $bbox[2] - $bbox[0];
$labelWidth += (5 * $scale); //b
$bbox = imagettfbbox((9 * $scale), 0, $font, $message); //b
$messageWidth = $bbox[2] - $bbox[0];
$imWidth = $labelWidth + $messageWidth + (15 * $scale); //b
$imHeight = (20 * $scale); //b


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
imagefilledrectangle($im, 0, 0, $labelWidth + (5 * $scale), $imHeight, $labelColor);



/* Creating the text on the badge. */
$bbox = imagettfbbox((9 * $scale), 0, $font, $label); //b
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, (9 * $scale), 0, (5 * $scale), (14* $scale), $colorText, $font, $label); //b


if($_GET['fontcolor'] == '' && $autoFontColor == true) {
$brightness = (hexdec(substr($messageColorHex, 1, 2)) * 0.299) + (hexdec(substr($messageColorHex, 3, 2)) * 0.587) + (hexdec(substr($messageColorHex, 5, 2)) * 0.114);
if ($brightness > 165) {
    $colorText = imagecolorallocate($im, 0, 0, 0);
} else {
    $colorText = imagecolorallocate($im, 255, 255, 255);
}
}

$bbox = imagettfbbox((9 * $scale), 0, $font, $message); //b
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, (9 * $scale), 0, $labelWidth + (10 * $scale), (14 * $scale), $colorText, $font, $message); //b

/* Setting the cache life. */
header('Cache-Control: max-age=' . $chacheLife . ', public');



// Downsizing the image, without losing quality.
/* resize using this method:
$originalImage = imagecreatefrompng('original.png');
$resizedImage = imagecreatetruecolor(300, 200); // new width and height
imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, 300, 200, imagesx($originalImage), imagesy($originalImage));
*/
if($resizeOutput == true) {
$resizedImage = imagecreatetruecolor(($imWidth / $scale), ($imHeight / $scale));
imagecopyresampled($resizedImage, $im, 0, 0, 0, 0, ($imWidth / $scale), ($imHeight / $scale), $imWidth, $imHeight);
$im = $resizedImage;
}

// Check if image is valid and output header 200 or 400
if($imWidth > 0 && $imHeight > 0) {
    header('HTTP/1.1 200 OK');
} else {
    header('HTTP/1.1 400 Bad Request');
}

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

// Tell client that request was successful

// ---Statistics & Update Reminder---
// Please do not remove or change this code. It is used to count the number of times a badge has been generated and to remind you to update PHP Badges.
// No personal data is stored or sent to the server!
$statistics = true; // Counts the number of times a badge has been generated.
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