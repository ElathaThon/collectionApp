<?php

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');
require_once('../model/initClasses.php');

$op = new Item();

$uuidUser = $_POST['uuidUser'];

if ($uuidUser != NULL){
    $items = $op->getPublicItemsWhitoutUserItems($uuidUser);
} else {
    $items = $op->getAllItems();
}


if ($items != ""){
    $arr->code = "1";
    $arr->ok = "ok";
    $arr->items = $items;
} else {
    $arr->code = "-1";
    $arr->ok = "ko";
    $arr->items = "Error";
}

echo json_encode($arr);


?>

