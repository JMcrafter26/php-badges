<?php

/**
 * Generate a badge image using PHP GD
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 */ $Version = '1.2.0'; /*
 * (c) 2023 JM26.NET
 */

/*--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--*/
/* Need help? Read the documentation at https://go.jm26.net/badge-docs or open an issue at       */
/* https://github.com/JMcrafter26/php-badges/issues/new/choose.                                  */
/*--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--!--*/



/*------------------SETTINGS--------------------*/
/*   Edit the settings below to change the      */
/*      default settings of the badge.          */
/*------------------SETTINGS--------------------*/

// Maintenance mode
$maintenace = false; // Set to true to enable maintenance mode 
$maintenacePassword = 'password'; // Password to access the badge while in maintenance mode
$icon = '&#xf09b;'; // Default Font Awesome icon
$label = 'Documentation:'; // Default label
$message = 'go.jm26.net/badge-docs'; // Default message
$labelColor = '#555555'; // Default label color
$messageColor = '#97CA00'; // Default message color
$colorText = '#ffffff'; // Default text color
$autoFontColor = true; // Automatically change the text color to black or white depending on the background color
// Advanced settings
$imageFormat = 'png'; // Default image format (png, jpg, gif)
$cacheLife = 5; // Default cache life (in seconds)
$scale = 20; //Image scale (Higher = Better quality, but bigger file size.)
$resizeOutput = false; //Downscale the output image to the original size. (!Reduces quality!)
$font = './DejaVuSans.woff'; // Download from https://dejavu-fonts.github.io
$icons = './font-awesome.woff'; // Download from https://fontawesome.com


/*----------------------------------------------*/
/* Do not edit anything below this line unless  */
/*      you know what you are doing!            */
/*----------------------------------------------*/

//Check if the maintenance mode is enabled
if ($maintenace == true && $_GET['password'] != $maintenacePassword) {
    header('Content-Type: image/png');
    readfile('https://i.imgur.com/iR3RI3Q.png'); // Download this image from https://api.jm26.net/badge/notice.png if imgur took it down.
    header('HTTP/1.0 503 Service Unavailable');
    die();
}

/* Checking if the fonts are downloaded, if they are not, it will download them. */
if (!file_exists($font)) {
    $fontDwnl = file_get_contents('https://api.jm26.net/badge/DejaVuSans.woff'); // This version of DejaVuSans.woff is modified to work with this script. Official version: https://dejavu-fonts.github.io
        file_put_contents($font, $fontDwnl);
    if (!file_exists($font)) {
        header('Content-Type: image/png');
        readfile('https://i.imgur.com/QfttAR6.png'); // Download this image from https://api.jm26.net/badge/err-font.png if imgur took it down.
    }
}
if (!file_exists($icons)) {
    $iconsDwnl = file_get_contents('https://api.jm26.net/badge/font-awesome.woff'); // This version of font-awesome.woff is modified to work with this script. Official version: https://fontawesome.com
        file_put_contents($icons, $iconsDwnl);
    if (!file_exists($icons)) {
        header('Content-Type: image/png');
        readfile('https://i.imgur.com/QfttAR6.png'); // Download this image from https://api.jm26.net/badge/err-font.png if imgur took it down.
    }
}


$dmis = true; //Default Message Is set, had to shorten it ;)


/* Checking if the label and message are set. If they are, it sets the  variable to false. */
if (isset($_GET['label'])) {
    $label = $_GET['label'];
    $label = htmlspecialchars($label);
    $dmis = false;
}
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $message = htmlspecialchars($message);
    $dmis = false;
}

/* Checking if the icon is set, if it is, it will set the icon to the unicode value. If it is not set,
it will set the icon to a square with a X in it. */
if (isset($_GET['icon'])) {
    // All icons are listed here: https://fontawesome.com/v5/cheatsheet/free/brands
    $icon = '&#x' . $_GET['icon'] . ';';
    //check if unicode is valid, dislay a invalid box
    if (mb_check_encoding($icon, 'UTF-8') === false) {
        $icon = '&';
    } elseif (strlen($icon) != 8) {
        $icon = '&';
    }
} elseif ($dmis == false) {
    $icon = '';
}


/* Checking if the user has specified a format, scale, resizeoutput, and cache. If they have, it sets
the variables to the user's input. If they haven't, it sets the variables to the default values. */
if (isset($_GET['format'])) {
    $imageFormat = $_GET['format'];
    $imageFormat = strtolower($imageFormat);
    if ($imageFormat != 'png' && $imageFormat != 'jpg' && $imageFormat != 'gif') {
        $imageFormat = 'png';
    }
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
if (isset($_GET['cache'])) {
    $cacheLife = $_GET['cache'];
    if (!is_numeric($cacheLife)) {
        $cacheLife = 5;
    } elseif ($cacheLife > 31536000) {
        $cacheLife = 31536000;
    } elseif ($cacheLife < 0) {
        $cacheLife = 1;
    }
}


/* Defining the colors for the graphs. */
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




/* Checking if the color is set and if it is not empty. If it is not empty, it will lowercase the
color. */
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
if (isset($_GET['labelcolor']) && $_GET['labelcolor'] != '') {
    //lowercase color
    $_GET['labelcolor'] = strtolower($_GET['labelcolor']);
    $labelColor = ${'color_' . $_GET['labelcolor']};
    if ($labelColor == '') {
        if (preg_match('/^[a-f 0-9]{6}$/i', $_GET['labelcolor'])) {
            $labelColor = $_GET['labelcolor'];
            $labelColor = '#' . $labelColor;
        } else {
            $labelColor = '#555555';
        }
    }
}

/* Checking if the fontcolor is set and if it is not empty. If it is not empty, it will lowercase the
color. Then it will check if the color is in the array. If it is not, it will check if it is a hex
color. If it is not, it will set the color to white. */
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

/* Checking if the value of the GET variable 'autofontcolor' is 'false' or 'true'. If it is 'false', it
sets the variable  to false. If it is 'true', it sets the variable  to
true. */
if ($_GET['autofontcolor'] == 'false') {
    $autoFontColor = false;
} elseif ($_GET['autofontcolor'] == 'true') {
    $autoFontColor = true;
}

/* This is setting the font, font color, and the size of the badge. */
if (isset($icon) && $icon != '') {
    $bbox = imagettfbbox((9 * $scale), 0, $font, $label);
    $labelWidth = $bbox[2] - $bbox[0];
    $labelWidth += (21 * $scale);
    $bbox = imagettfbbox((9 * $scale), 0, $font, $message);
    $messageWidth = $bbox[2] - $bbox[0];
    $imWidth = $labelWidth + $messageWidth + (15 * $scale);
    $imHeight = (20 * $scale);
} else {
    /* This is setting the font, font color, and the size of the badge. */
    $bbox = imagettfbbox((9 * $scale), 0, $font, $label);
    $labelWidth = $bbox[2] - $bbox[0];
    $labelWidth += (5 * $scale);
    $bbox = imagettfbbox((9 * $scale), 0, $font, $message);
    $messageWidth = $bbox[2] - $bbox[0];
    $imWidth = $labelWidth + $messageWidth + (15 * $scale);
    $imHeight = (20 * $scale);
}




/* Creating a new image with the width and height of the badge. */
$im = imagecreatetruecolor($imWidth, $imHeight);

/* Setting the color of the badge. */
$labelColorackground = imagecolorallocate($im, 255, 255, 255);
$colorText = imagecolorallocate($im, hexdec(substr($colorText, 1, 2)), hexdec(substr($colorText, 3, 2)), hexdec(substr($colorText, 5, 2)));
$messageColorHex = $messageColor;
$messageColor = imagecolorallocate($im, hexdec(substr($messageColor, 1, 2)), hexdec(substr($messageColor, 3, 2)), hexdec(substr($messageColor, 5, 2)));
$labelColorHex = $labelColor;
$labelColor = imagecolorallocate($im, hexdec(substr($labelColor, 1, 2)), hexdec(substr($labelColor, 3, 2)), hexdec(substr($labelColor, 5, 2)));


/* Creating the badge. */
imagefilledrectangle($im, 0, 0, $imWidth, $imHeight, $messageColor);
imagefilledrectangle($im, 0, 0, $labelWidth + (5 * $scale), $imHeight, $labelColor);

/* Checking if the font color is set, and if it is not, it is setting the font color to black or white
depending on the brightness of the background color. */
if ($_GET['fontcolor'] == '' && $autoFontColor == true) {
    $brightness = (hexdec(substr($labelColorHex, 1, 2)) * 0.299) + (hexdec(substr($labelColorHex, 3, 2)) * 0.587) + (hexdec(substr($labelColorHex, 5, 2)) * 0.114);
    if ($brightness > 165) {
        $labelColorText = imagecolorallocate($im, 0, 0, 0);
    } else {
        $labelColorText = imagecolorallocate($im, 255, 255, 255);
    }
}

/* Drawing the text on the image. */
if (isset($icon) && $icon != '') {
    $bbox = imagettfbbox((9 * $scale), 0, $icons, $icon);
    $textWidth = $bbox[2] - $bbox[0];
    imagettftext($im, (11 * $scale), 0, (5 * $scale), (15 * $scale), $labelColorText, $icons, $icon);
    // now draw label after icon with offset of 14px (icon width) + 5px (padding)
    $bbox = imagettfbbox((9 * $scale), 0, $font, $label);
    $textWidth = $bbox[2] - $bbox[0];
    imagettftext($im, (9 * $scale), 0, (21 * $scale), (14 * $scale), $labelColorText, $font, $label);
    // imagettftext(image| size,  |angle| x          | y            |    color, |fontfile| text)
} else {
    $bbox = imagettfbbox((9 * $scale), 0, $font, $label);
    $textWidth = $bbox[2] - $bbox[0];
    imagettftext($im, (9 * $scale), 0, (5 * $scale), (14 * $scale), $colorText, $font, $label);
}

/* Checking if the font color is set to auto. If it is, it will check the brightness of the background
color. If the brightness is greater than 165, it will set the font color to black. If the brightness
is less than 165, it will set the font color to white. */
if ($_GET['fontcolor'] == '' && $autoFontColor == true) {
    $brightness = (hexdec(substr($messageColorHex, 1, 2)) * 0.299) + (hexdec(substr($messageColorHex, 3, 2)) * 0.587) + (hexdec(substr($messageColorHex, 5, 2)) * 0.114);
    if ($brightness > 165) {
        $colorText = imagecolorallocate($im, 0, 0, 0);
    } else {
        $colorText = imagecolorallocate($im, 255, 255, 255);
    }
}

/* The above code is creating a text box and then writing the message in the text box. */
$bbox = imagettfbbox((9 * $scale), 0, $font, $message);
$textWidth = $bbox[2] - $bbox[0];
imagettftext($im, (9 * $scale), 0, $labelWidth + (10 * $scale), (14 * $scale), $colorText, $font, $message);

/* Setting the cache life. */
header('Cache-Control: max-age=' . $cacheLife . ', public');



/* Resizing the image to a smaller size. Also means a poor quality image. */
if ($resizeOutput == true) {
    $resizedImage = imagecreatetruecolor(($imWidth / $scale), ($imHeight / $scale));
    imagecopyresampled($resizedImage, $im, 0, 0, 0, 0, ($imWidth / $scale), ($imHeight / $scale), $imWidth, $imHeight);
    $im = $resizedImage;
}



// Check if image is valid and output header 200 or 400
if ($imWidth > 1 && $imHeight > 1) {
    header('HTTP/1.1 200 OK');
} else {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: image/png');
    readfile('https://i.imgur.com/12cgeqB.png');
    exit;
}

/* Setting the header for the image for better accessibility. */
header('Content-Disposition: inline; filename="' . $label . '-' . $message . '(PHP-Badges).' . $imageFormat . '"; alt="' . $label . ' ' . $message . '"');

/* Setting the content type to image/png and then outputting the image. */
header('Content-Type: image/' . $imageFormat);
imagepng($im);



/* Destroying the image. (This is not needed, but it is good practice.) */
imagedestroy($im);



// ---Statistics & Update Reminder---
// Please do not remove or change this code. It is used to count the number of times a badge has been generated and to remind you to update PHP Badges.
// No personal data is stored or sent to the server!

$statistics = true; // To get an update reminder, statistics need to be set to 'true'. Statistics and Updates are using the same endpint!
if ($statistics) {
    $statisticsUrl = 'https://api.jm26.net/badge/statistics.php?exp=' . md5('statistics' . date('h-i-d-m-Y')) . '&v=' . $Version; //please do not change this url, else it won't work :(
    $statistics = file_get_contents($statisticsUrl);
    if ($statistics != 'success' && file_exists('./PLEASE-UPDATE-PHP-BADGES.txt') == false) {
        $file = fopen('./PLEASE-UPDATE-PHP-BADGES.txt', 'w');
        fwrite($file, 'A new version is available. Please update PHP Badges to the latest version. \n You can download the latest version at https://github.com/JMcrafter26/php-badges/releases/latest \n  \n Happy coding! timestamp: ' . time() . ' Current version: ' . $Version . ' Newest Version: ' . $statistics . '');
        fclose($file);
        chmod('./PLEASE-UPDATE-PHP-BADGES.txt', 770);
    } elseif (file_exists('./PLEASE-UPDATE-PHP-BADGES.txt') == true) {
        // Delete the file if the version is up to date.
        unlink('./PLEASE-UPDATE-PHP-BADGES.txt');
    }
}

exit;

// if you see this go to https://go.jm26.net/badges-easteregg to see something cool