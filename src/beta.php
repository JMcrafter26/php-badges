<?php

/**
 * Generate a badge image using PHP GD
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 */ $Version = '1.2.1'; /*
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
$maintenacePassword = 'password'; // Password to access the badge while in maintenance mode and to view the status page of the badge generator
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
$scale = 15; // Image scale (Higher = Better quality, but bigger file size.)
$maxScale = 100; // Maximum image scale
$resizeOutput = false; // Downscale the output image to the original size. (!Reduces quality!)
$font = './DejaVuSans.woff'; // Download from https://dejavu-fonts.github.io
$icons = './font-awesome.woff'; // Download from https://fontawesome.com


$dmis = true; //Default Message Is set, had to shorten it ;)
/* Defining the colors for the graphs. */
$color_random = '#' . substr(md5(mt_rand()), 0, 6);
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

/*----------------------------------------------*/
/* Do not edit anything below this line unless  */
/*      you know what you are doing!            */
/*----------------------------------------------*/
// Update settings
// Please do not remove or change this code. It is used to count the number of times a badge has been generated and to remind you to update PHP Badges.
// No personal data is stored or sent to the server!
$checkForUpdates = true; // To get an update reminder, statistics need to be set to 'true'. Statistics and Updates are using the same endpint!


// check if the url contains status and the status parameter is set to the password
if (isset($_GET['status']) && !isset($_GET['message']) && !isset($_GET['label'])) {
    //check things
    $status = 'ok';
    $badgeMessage = $message;
    $message = '';
    $warnings = 0;

    // if maintenance mode is enabled, show a warning
    if ($maintenace) {
        $status = 'warning';
        $message .= 'Maintenance mode is enabled/';
        $warnings++;
    }

    // check if the php gd extension is installed
    if (!extension_loaded('gd') && !function_exists('gd_info')) {
        $status = 'error';
        $status_gd = 'false';
        $message .= 'PHP GD extension is not installed/';
        $warnings++;
    } else {
        $status_gd = 'true';
    }
    // check if the fonts are downloaded
    if (!file_exists($font)) {
        $status = 'error';
        $status_font = 'false';
        $message .= 'DejaVuSans.woff is not downloaded/';
        $warnings++;
    } else {
        $status_font = 'true';
    }
    if (!file_exists($icons)) {
        $status = 'error';
        $status_icons = 'false';
        $message .= 'font-awesome.woff is not downloaded/';
        $warnings++;
    } else {
        $status_icons = 'true';
    }
    // check if is connected to the internet
    if (!@fsockopen('www.google.com', 80)) {
        $status_internet = 'offline';
        $status = 'false';
        $message .= 'Not connected to the internet/';
    } else {
        $status_internet = 'true';
    }
    // get server info
    $server = $_SERVER['SERVER_SOFTWARE'];
    $server = explode('/', $server);
    $server = $server[0];
    // get php version
    $php = phpversion();

    // check if api.jm26.net/badge is online
    if (!@fsockopen('api.jm26.net', 80)) {
        $status_update = 'false';
        $status = 'error';
        $message .= 'api.jm26.net/badge is offline/';
        $warnings++;
        
    } else {
        $status_update = 'true';
    }

    //check if github repo does not return a 404
    $github = get_headers('https://raw.githubusercontent.com/JMcrafter26/php-badges/main/README.md');
    if ($github[0] == 'HTTP/1.1 404 Not Found') {
        $status_github = 'false';
        $status = 'error';
        $message .= 'Github repo not found/';
        $warnings++;
    } else {
        $status_github = 'true';
    }

    // check for new version
    $newVersion = file_get_contents('https://raw.githack.com/JMcrafter26/php-badges/main/stable-version.json');
    // if the file is empty, set the status to error and set the message to 'Could not get the latest version'
    if ($newVersion == '') {
        $status = 'error';
        $message .= 'Could not get the latest version/';
        $warnings++;
    }
    $newVersion = json_decode($newVersion, true);
    $newVersion = $newVersion['Version']['Stable'];
    if ($newVersion > $Version) {
        $status = 'error';
        $message .= 'New version available/';
        $warnings++;
        $updateAvailable = true;
    } else {
        $updateAvailable = false;
    }

    // if checkForUpdates is set to false, set the status to error and set the message to 'Update check disabled'
    if ($checkForUpdates == false) {
        $status = 'error';
        $message .= 'Update check disabled';
        $warnings++;
    }

    if ($warnings == 0) {
        $message = 'Everything is working fine!';
    } 


    $json = array(
        "status" => $status,
        "warnings" => $warnings,
        "message" => $message,
        "version" => array(
            "current version" => $Version,
            "newest version" => $newVersion,
            "update available" => $updateAvailable,
            "check for updates" => $checkForUpdates,
            "update url" => "https://github.com/JMcrafter26/php-badges/releases/latest"
        ),
        "server" => array(
        "server" => $server,
        "php" => $php,
        "directory" => getcwd(),
        "file" => __FILE__,
        "host" => $_SERVER['SERVER_NAME'],
        "ip" => $_SERVER['SERVER_ADDR'],
        "gd extension" => $status_gd
        ),
        "assets" => array(
            "font" => $status_font,
            "icons" => $status_icons
        ),
        "external services" => array(
            "internet" => $status_internet,
            "github repo" => $status_github,
            "update server" => $status_update
        ),
        "configuration" => array(
            "maintenance mode" => $maintenace,
            "icon" => $icon,
            "label" => $label,
            "message" => $badgeMessage,
            "label color" => $labelColor,
            "message color" => $messageColor,
            "color text" => $colorText,
            "auto font color" => $autoFontColor,
            "image format" => $imageFormat,
            "cachelife" => $cacheLife,
            "scale" => $scale,
            "resize output" => $resizeOutput,
            "font path" => $font,
            "icons path" => $icons,
        )

    );
    if ($_GET['status'] == $maintenacePassword) {
    header('Content-Type: application/json');
    $json = json_encode($json, JSON_PRETTY_PRINT);
    echo $json;
    die();

    } else {
        $dmis = false;
        $label = 'Status';
        $message = $json['status'];
        if ($json['status'] == 'ok') {
            $color = $color_ok;
        } else {
            $color = $color_critical;
        }
    }
}


//Check if the maintenance mode is enabled
if ($maintenace == true && $_GET['password'] != $maintenacePassword) {
    header('Content-Type: image/png');
    readfile('https://i.imgur.com/iR3RI3Q.png'); // Download this image from https://api.jm26.net/badge/notice.png if imgur took it down.
    header('HTTP/1.0 503 Service Unavailable');
    die();
}

// check if the php gd extension is installed
if (!extension_loaded('gd') && !function_exists('gd_info')) {
    header('Content-Type: image/png');
    readfile('https://i.imgur.com/S8dD7GE.png'); // Download this image from https://api.jm26.net/badge/err-ext.png if imgur took it down.
    header('HTTP/1.0 500 Internal Server Error');
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


if (isset($_GET['url']) && !empty($_GET['url'])) {
    // A dynamic badge is requested with parameters like shields.io e.g. /github/stars/:user/:repo

    $url = $_GET['url'];
    $url = htmlspecialchars($url);

    // if the url starts with http
    if (substr($url, 0, 4) != 'http') {

        // if $url starts with a slash, remove it
        if (substr($url, 0, 1) == '/') {
            $url = substr($url, 1);
        }
        // if $url ends with a slash, remove it
        if (substr($url, -1) == '/') {
            $url = substr($url, 0, -1);
        }
        // if $url ends with .json, remove it
        if (substr($url, -5) == '.json') {
            $url = substr($url, 0, -5);
        }
        // get the json from the shields.io api
        $url = 'https://img.shields.io/' . $url . '.json';
    }


    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $label = 'Error';
        $message = 'Invalid URL';
        $messageColor = 'red';
    } else {
        $json = file_get_contents($url);
        //$json = htmlspecialchars($json);
        $json = json_decode($json, true);

        // check if url is a valid url

        $dmis = true;

        // check if the json is valid
        if ($json == null) {
            $label = 'Error';
            $message = 'Invalid JSON';
            $messageColor = 'red';
        } else {
            // check if the json has the required keys
            if (array_key_exists('label', $json) or array_key_exists('message', $json) or array_key_exists('color', $json) or array_key_exists('value', $json)) {
                $label = $json['label'];
                if (!isset($json['message']) and isset($json['value'])) {
                    $message = $json['value'];
                } else {
                    $message = $json['message'];
                }

                $jsonFormat = $_GET['format'];
                $jsonFormat = strtolower($jsonFormat);
                if ($jsonFormat == 'low') {
                    $label = strtolower($label);
                    $message = strtolower($message);
                } elseif ($jsonFormat == 'up') {
                    $label = strtoupper($label);
                    $message = strtoupper($message);
                } elseif ($jsonFormat == 'cap') {
                    $label = ucwords($label);
                    $message = ucwords($message);
                } elseif ($jsonFormat == 'capf') {
                    $label = ucfirst($label);
                    $message = ucfirst($message);
                } elseif ($jsonFormat == 'low-l') {
                    $label = strtolower($label);
                } elseif ($jsonFormat == 'up-l') {
                    $label = strtoupper($label);
                } elseif ($jsonFormat == 'cap-l') {
                    $label = ucwords($label);
                } elseif ($jsonFormat == 'capf-l') {
                    $label = ucfirst($label);
                } elseif ($jsonFormat == 'low-m') {
                    $message = strtolower($message);
                } elseif ($jsonFormat == 'up-m') {
                    $message = strtoupper($message);
                } elseif ($jsonFormat == 'cap-m') {
                    $message = ucwords($message);
                } elseif ($jsonFormat == 'capf-m') {
                    $message = ucfirst($message);
                }


                $jsonColor = $json['color'];
                // lowercase the color
                $jsonColor = strtolower($jsonColor);
                $messageColor = ${'color_' . $jsonColor};
                if ($messageColor == '') {
                    if (preg_match('/^[a-f 0-9]{6}$/i', $jsonColor)) {
                        $messageColor = $jsonColor;
                        $messageColor = '#' . $messageColor;
                    } else {
                        // $messageColor = '#e05d44';
                    }
                }
            } else {
                $label = 'Error';
                $message = 'Invalid JSON (No Data)';
                $messageColor = 'red';
            }
        }
    }
}

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
    if (!is_numeric($scale) || $scale > $maxScale || $scale < 0.1) {
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
if (isset($_GET['autofontcolor']) && $_GET['autofontcolor'] == 'false') {
    $autoFontColor = false;
} elseif (isset($_GET['autofontcolor']) && $_GET['autofontcolor'] == 'true') {
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
$labelColorText = $colorText;

/* Creating the badge. */
imagefilledrectangle($im, 0, 0, $imWidth, $imHeight, $messageColor);
imagefilledrectangle($im, 0, 0, $labelWidth + (5 * $scale), $imHeight, $labelColor);

/* Checking if the font color is set, and if it is not, it is setting the font color to black or white
depending on the brightness of the background color. */
if (isset($_GET['fontcolor']) && $_GET['fontcolor'] != '') {
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
if (isset ($_GET['fontcolor']) && $_GET['fontcolor'] != '' && $autoFontColor == true) {
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
// get the image size
$imWidth = imagesx($im);
$imHeight = imagesy($im);
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

if ($checkForUpdates) {
    $statisticsUrl = 'https://api.jm26.net/badge/statistics.php?exp=' . md5('statistics' . date('h-i-d-m-Y')) . '&v=' . $Version; //please do not change this url, else it won't work :(
    $checkForUpdates = file_get_contents($statisticsUrl);
    if ($checkForUpdates != 'success' && file_exists('./PLEASE-UPDATE-PHP-BADGES.txt') == false) {
        $file = fopen('./PLEASE-UPDATE-PHP-BADGES.txt', 'w');
        fwrite($file, 'A new version is available. Please update PHP Badges to the latest version. \n You can download the latest version at https://github.com/JMcrafter26/php-badges/releases/latest \n  \n Happy coding! timestamp: ' . time() . ' Current version: ' . $Version . ' Newest Version: ' . $checkForUpdates . '');
        fclose($file);
        chmod('./PLEASE-UPDATE-PHP-BADGES.txt', 770);
    } elseif (file_exists('./PLEASE-UPDATE-PHP-BADGES.txt') == true) {
        // Delete the file if the version is up to date.
        unlink('./PLEASE-UPDATE-PHP-BADGES.txt');
    }
}
exit;

// if you see this go to https://go.jm26.net/badges-easteregg to see something cool