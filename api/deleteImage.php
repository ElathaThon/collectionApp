<?php 

error_reporting(0);
header('Content-Type: application/json');
// header('Content-Type: text/html; charset=utf-8');

require_once ('../core/Ini.php');
require_once('../model/initClasses.php');

$op = new Image();

$uuidImage = $_POST['uuidImage'];
//$uuidImage = $_GET['uuidImage'];

//Eliminem la img del server
$base_directory = '../images/';

$url = $op->getUrlImage($uuidImage);
//echo $base_directory.$url;

if(unlink($base_directory.$url)){
    //Borrem de la BBDDD
    $deleteImage = $op->deleteImage($uuidImage);

    $arr->deletedServer = "ok";
} else {
    $arr->deletedServer = "ko";
}


if ($deleteImage == "ok"){
    $arr->code = "1";
    $arr->ok = "ok";
    $arr->deleteImage = $deleteImage;
} else {
    $arr->code = "-1";
    $arr->ok = "ko";
    $arr->deleteImage = "Error";
}

echo json_encode($arr);


?>