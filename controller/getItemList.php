<?php

session_start();

error_reporting(0);
header('Content-Type: application/json');

require_once('../core/Ini.php');
require_once('../model/initClasses.php');

$op = new Item();

$uuidUser = $_SESSION['userUUID'];


if ($uuidUser != NULL) {
    //Els items del user + items publics
    $items = $op->getItemsFromUserUUID($uuidUser);
    $itemsPublic = $op->getPublicItemsWhitoutUserItems($uuidUser);
} else {
    //Nomes els items publics
    $itemsPublic = $op->getAllItems();
}


if ($items != "" or $itemsPublic != ""){
    $arr->code = "1";
    $arr->ok = "ok";
    $arr->items = $items;
    $arr->itemsPublic = $itemsPublic;
} else {
    $arr->code = "-1";
    $arr->ok = "ko";
    $arr->items = "Error";
    $arr->itemsPublic = "Error";
}

echo json_encode($arr);



?>