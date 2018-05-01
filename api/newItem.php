<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');

$op = new Connection();

$uuid = uniqid();
$name = $_POST['name'];
$description = $_POST['description'];
//$name = "patata";
//$description = "la description";

$createItem = $op->createNewItem($uuid, $name, $description);

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