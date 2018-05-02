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

<div class="col-sm-6 col-lg-5">
<form action="createPhotosItem.php" id="addItemPhotos" name="addItemPhotos" method="POST" enctype="multipart/form-data" >
	  <center><h4>Imatges relaiconades</h4></center>
	   
        <input type="hidden" name="uuidItem" id="uuidItem" <?php echo 'value="'.$uuid.'"'; ?> />
        <table width="100%">
            <tr>
                <td>Selecciona las fotos relacionades amb el producte</td>
                <td><input type="file" name="files[]" multiple/></td>
            </tr>
            <tr>
                <td colspan="2" align="center">Note: Formatos de imagen soportados: .jpeg, .jpg, .png, .gif</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Añadir fotos" id="selectedButton"/></td>
            </tr>
        </table>                                    
    </form>
	        
	</div>
</form>



 </body>
 </html>