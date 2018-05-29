<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');

$op = new Connection();

$uuidItem = $_POST['uuidItem'];

$urlImage = $op->getFavoriteImage($uuidItem);

if ($urlImage != ""){
    $arr->code = "1";
    $arr->ok = "ok";
    $arr->urlImage = $urlImage;
} else {
    $arr->code = "-1";
    $arr->ok = "ko";
    $arr->urlImage = "Error";
}

echo json_encode($arr);



 ?>