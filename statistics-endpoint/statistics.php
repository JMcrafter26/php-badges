<?php 
/**
 * This file listens for a request from the generate.php file and then adds a count to the statistics.json file
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 * Version: 1.1.2
 * (c) 2023 JM26.NET
 */

//check Hash
if (isset($_GET['exp']) && $_GET['exp'] != '') {
  $hash = md5('statistics' . date('h-i-d-m-Y'));
  if($_GET['exp'] != $hash) {
    header('HTTP/1.1 403 Forbidden');
    exit();
  }
  if(isset($_GET['v'])) {
    $stable = file_get_contents('https://raw.githubusercontent.com/JMcrafter26/php-badges/main/stable-version.json');
    $stable = json_decode($stable, true);
    $stable = $stable['Version']['Stable'];
    // remove dots from version
    $stable = str_replace('.', '', $stable);
    $current = $_GET['v'];
    $current = str_replace('.', '', $current);
    header('HTTP/1.1 200 OK');
    if($current > 113 && $stable > $current) {
      echo $stable;
    }elseif($stable > $current ) {
		echo 'update';
		}else{
      echo 'success';
    }
  }

    // open the file for reading and writing
$fp = fopen('count.txt', 'r+');

// lock the file
flock($fp, LOCK_EX);

// get the current count
$data = fread($fp, filesize('count.txt'));

// increment the count
$data = $data + 1;

// seek to the beginning of the file
fseek($fp, 0);

// write the new count
fwrite($fp, $data);

// unlock the file
flock($fp, LOCK_UN);

// close the file
fclose($fp);

exit();

} else {

//display badge from https://test.jm26.net/api/badge?label=Times%20Generated&message=0&color=blue

//get data
$count = file_get_contents('count.txt');

if($_GET['accuratecount'] != 'true') {
if ($count >= 1000000000) {
  $count = round($count / 1000000000, 1) . 'B';
} elseif ($count >= 1000000) {
  $count = round($count / 1000000, 1) . 'M';
} elseif ($count >= 1000) {
  $count = round($count / 1000, 1) . 'K';
}
}


//display badge
header('HTTP/1.1 200 OK');
header('Content-Type: image/png');
readfile('https://api.jm26.net/badge?label=Times%20Generated&message=' . $count . '&color=blue&format=png');

exit();
}