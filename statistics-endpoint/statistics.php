<?php 
/**
 * This file listens for a request from the generate.php file and then adds a count to the statistics.json file
 * Author: @JMcrafter26 | https://test.jm26.net/shields-badges | https://github.com/JMcrafter26/php-badges
 * License: MIT
 * Version: 1.1.2
 * (c) 2023 JM26.NET
 */

//check Hash
$hash = md5('statistics' . date('h-i-d-m-Y'));
if (isset($_GET['exp']) && $_GET['exp'] == $hash) {
    echo 'success';
    //get data
    $data = file_get_contents('statistics.json');
    $data = json_decode($data, true);
    $data['count'] = $data['count'] + 1;
    $data = json_encode($data);
    file_put_contents('statistics.json', $data);
    die();
}

//display badge from https://test.jm26.net/api/badge?label=Times%20Generated&message=0&color=blue

//get data
$data = file_get_contents('statistics.json');
$data = json_decode($data, true);
$count = $data['count'];

//display badge
header('Content-Type: image/png');
readfile('https://test.jm26.net/api/badge?label=Times%20Generated&message=' . $count . '&color=blue');
?>
