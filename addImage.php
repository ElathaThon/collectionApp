<?php 
require_once ('core/Ini.php');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Afegir imatges</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="css/main.css" >


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


 </head>
 <body>
 
<?php 

$name = $_POST['name'];
$description =$_POST['description'];
$uuid = $_POST['uuid'];
//echo "> Dades: [name: " . $name . ", description: " . $description . ", uuid: " . $uuid . "]";

?>

<script>
function goBack() {
    window.history.back();
}
</script>

<style>body { padding-top:50px; }.navbar-inverse .navbar-nav > li > a { color: #DBE4E1; }</style>


<div class="container">

      <div style="max-width: 650px; margin: auto;">
        <h1 class="page-header">Upload images for <?php echo $item['name']; ?></h1>
        <p class="lead">Seleccionar imatges en .JPEG, .JPG, .PNG, .GIF</p>

        <form action="createPhotosItem.php" id="addItemPhotos" name="addItemPhotos" method="POST" enctype="multipart/form-data">
          
          <input type="hidden" name="uuidItem" id="uuidItem" <?php echo 'value="'.$uuid.'"'; ?> />
          <div class="form-group">
            <input type="file" name="files[]" multiple required />
          </div>


          <button class="btn btn-lg btn-primary" id="upload-button" type="submit">Upload image</button>
        </form>

        <button style="position: absolute; top: 50px; right: 50px; border: 0;" class="btn btn-danger right-back" onclick="goBack()">Go Back</button>

    </div>

 </body>
 </html>