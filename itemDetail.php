<?php 
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING);
require_once ('core/Ini.php');
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

</head>
<body>

<?php 

$op = new Connection();
$item = $op->getItemByUUID($_GET['uuid']);
$item = $item[0];
//print_r($item);

$itemPhotos = $op->getItemImages($_GET['uuid']);
//print_r($itemPhotos)

?>


<script>
function goBack() {
    window.location.href = "index.php";

}
</script>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2><?php echo $item['name']; ?></h2>

        <div>
            <button class="btn btn-danger right-back" onclick="goBack()">Go Back</button>
        </div>
        <form role="form" method="POST" id="newImage_form" action="addImage.php">
            <div class="row">

            	<input name="uuid" id="uuid" type="hidden" <?php echo "value='".$item["uuid"]."'"; ?>>

            	<div class="col-sm-6 form-group">
                    <label for="name">
                        Name:</label>
                    <input <?php echo "value='".$item["name"]."'"; ?> type="text" class="form-control" id="name" name="name"  maxlength="50">
                </div>

                <div class="col-sm-12 form-group">
                    <label for="name">
                        Description:</label>
                    <textarea class="form-control" type="textarea" id="description" name="description" maxlength="6000" rows="7">
                    	<?php echo $item["description"]; ?>
                	</textarea>
                </div>
            </div>
            
            <?php 
            
            if (empty($itemPhotos)) {
                 $formSummit = '<div class="row">
                    <div class="col-sm-12 form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Afegir una imatge</button>
                    </div>
                </div>';

            } else {
                $formSummit = '<div class="row">
                    <div class="col-sm-12 form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Afegir una imatge</button>
                        <button type="submit" class="btn btn-lg btn-warning btn-block" id="btnFavorite" onclick="starImage()"><i class="far fa-star"></i>  Favorite </button>
                    </div>
                </div>';
            }

            echo $formSummit;

            ?>

        </form>

    </div>
</div>





<div class="row">
	<div class="col-md-6 col-md-offset-3">
	        <?php
	        for ($i = 0; $i < sizeof($itemPhotos); $i++){
	            echo '
	            <div class="gallery">
					<a target="_blank" href="images/'.$itemPhotos[$i]['url'].'">
					    <img src="images/'.$itemPhotos[$i]['url'].'" alt="itemImage" width="300" height="200">
				 	</a>
				 	<!--<div class="desc">Add a description of the image here</div>-->
				</div>';
	        }
	        ?>
	</div>
</div>


</body>
</html>