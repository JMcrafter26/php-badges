<?
//header allow origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

// read file iconlist.json and return it
$iconlist = file_get_contents('iconlist.json');
header('Content-Type: application/json');
echo $iconlist;
?>
