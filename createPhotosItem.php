<?php 
require_once ('core/Ini.php');
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Upliading images....</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="css/main.css" >


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

 </head>
 <body>
    <div class="row">
	    <div class="col-lg-12">
	        <?php
	        $op = new Connection();

	        extract($_POST);
	        $error=array();
	        $extension=array("jpeg","jpg","png","gif");
	        $pathImages = "images/";
	        $controlador = true;

	        $uuidItem = $_POST['uuidItem'];

	        foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
	            $file_name=$_FILES["files"]["name"][$key];
	            $file_tmp=$_FILES["files"]["tmp_name"][$key];
	            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
	            if(in_array($ext,$extension)) {
	                //if(!file_exists($pathImages.$file_name)) {
                	if(1==2) {
                		//En el cas de que volguessim conservar el nom de les imatges
	                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],$pathImages.$file_name);
	                    $uuid = uniqid();
	                    $url = "laUrl.jpg";
	                    $upload = $op->createNewImage($uuid, $uuidItem, $url);
	                    //echo "upload got : ".$upload."<br>";

	                } else {
	                    $filename=basename($file_name,$ext);
	                    $uuid = uniqid();
	                    $newFileName=$uuid.".".$ext;
	                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],$pathImages.$newFileName);
	                    $url = $newFileName;
	                    $upload = $op->createNewImage($uuid, $uuidItem, $url);
	                    //echo "upload got : ".$upload."<br>";

	                    }
	            } else {
	                $controlador = false;
	                array_push($error,"$file_name, ");
	            }
	        }
	        // echo "fuera del foreach!";
	        if ($controlador){
	            echo "<center><h3>Fotos subidas correctamente</h3></center>";
	            $url = "itemDetail.php?uuid=".$uuidItem;
	            $secs = 2;
	            $op->redirectTo($url,$secs);
	        } else {
	            echo "<center><h3>Error al subir las fotos</h3></center>";
	            $url = "itemDetail.php?uuid=".$uuidItem;
	            $secs = 2;
	            $op->redirectTo($url,$secs);
	        }
	        ?>
	    </div>
    </div>                       

 </body>
 </html>