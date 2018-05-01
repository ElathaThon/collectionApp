<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');

$op = new Connection();

$uuid = uniqid();
$name = $_POST['name'];
//$name = "patata";

$createItem = $op->createNewItem($uuid,$name);

echo $uuid;
if ($createItem != ""){
	$arr->code = "1";
	$arr->ok = "ok";
	$arr->createItem = $createItem;
} else {
	$arr->code = "-1";
	$arr->ok = "ko";
	$arr->createItem = "Error";
}

echo json_encode($arr);

?>