<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');

$op = new Connection();

$uuid = $_POST['uuid'];
$name = $_POST['name'];
$description = $_POST['description'];


$updateItem = $op->updateItem($uuid, $name, $description);

if ($updateItem == "ok"){
    $arr->code = "1";
    $arr->ok = "ok";
    $arr->updateItem = "ok";
} else {
    $arr->code = "-1";
    $arr->ok = "ko";
    $arr->updateItem = "Error";
}

echo json_encode($arr);


?>