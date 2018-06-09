<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');
require_once('../model/initClasses.php');

$op = new Item();

$uuid = $_POST['uuid'];

$deleteItem = $op->deleteItem($uuid);

if ($deleteItem != ""){
	$arr->code = "1";
	$arr->ok = "ok";
    $arr->uuid = $uuid;
	$arr->deleteItem = $deleteItem;
} else {
	$arr->code = "-1";
	$arr->ok = "ko";
	$arr->deleteItem = "Error";
}

echo json_encode($arr);


?>