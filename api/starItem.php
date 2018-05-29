<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');

$op = new Connection();

$uuidItem = $_POST['uuidItem'];
$uuidImage = $_POST['uuidImage'];

$starItem = $op->updateStarItemImage($uuidItem, $uuidImage);

if ($starItem != ""){
    $arr->code = "1";
    $arr->ok = "ok";
    //$arr->uuidItem = $uuidItem;
    //$arr->uuidImage = $uuidImage;
    $arr->starItem = $starItem;
} else {
    $arr->code = "-1";
    $arr->ok = "ko";
    $arr->starItem = "Error";
}

echo json_encode($arr);

 ?>