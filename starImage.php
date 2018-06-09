<?php 

require_once ('core/Ini.php');
require_once ('model/initClasses.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Detall del item</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="css/main.css" >
<link rel="stylesheet" href="css/gallery.css" >

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- JS controller to delete items -->
<script src="js/starImageController.js"></script>

</head>
<body>

<?php 
$name = $_POST['name'];
$description =$_POST['description'];
$uuid = $_POST['uuid'];
//echo "> Dades: [name: " . $name . ", description: " . $description . ", uuid: " . $uuid . "]";

$op = new Image();
$itemPhotos = $op->getItemImages($_POST['uuid']);
//print_r($itemPhotos);

?>


<div class="row">
    <div class="col-md-6 col-md-offset-3">
            <?php
            for ($i = 0; $i < sizeof($itemPhotos); $i++){
                echo '
                <div class="gallery">
                    <button class="btn btn-link" onclick="starItem(\''.$itemPhotos[$i]['uuidItem'].'\',\''.$itemPhotos[$i]['uuid'].'\')" >
                        <img src="images/'.$itemPhotos[$i]['url'].'" alt="itemImage" width="300" height="200">
                    </button>
                </div>';
            }
            ?>
    </div>
</div>

</body>
</html>