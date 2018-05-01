<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');

$op = new Connection();

$items = $op->getAllItems();

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