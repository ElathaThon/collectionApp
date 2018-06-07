<?php 
require_once ('core/Ini.php');


$op = new Connection();
$item = $op->getItemByUUID($_GET['uuid']);
$item = $item[0];

$uuid = $item['uuid'];
?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Eliminar item</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="css/main.css" >


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- JS controller to delete items -->
<script src="js/deleteItemController.js"></script>

</head>
<body>

<style>body { padding-top:50px; }.navbar-inverse .navbar-nav > li > a { color: #DBE4E1; }</style>


<div class="container">

      <div style="max-width: 650px; margin: auto;">
        <h1 class="page-header">Eliminar <?php echo $item['name']; ?></h1>
        <p class="lead">Un cop eliminat no es podrà recuperar, totes les imatges d'aquest producte també es borraràn!</p>
        <p>Segur que el vols eliminar?</p>

        <!--<form action="api/deleteItem.php" id="deleteItem" name="deleteItem" method="POST" enctype="multipart/form-data">-->
        <form id="deleteItem" name="deleteItem" method="POST" enctype="multipart/form-data">
          
          <input type="hidden" name="uuid" id="uuid" <?php echo 'value="'.$uuid.'"'; ?> />
          
          <button class="btn btn-lg btn-danger" id="upload-button" type="submit" onclick="deleteItemController()">Eliminar</button>
          <button class="btn btn-lg btn-primary" id="upload-button" formaction="index.php" type="submit">Cancelar</button>
        </form>

        <button style="position: absolute; top: 50px; right: 50px; border: 0;" class="btn btn-primary right-back" onclick="goBack()">Go Back</button>

    </div>



</body>
</html>