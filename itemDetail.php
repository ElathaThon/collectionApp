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

<script src="js/detailController.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>

<?php 

$ItemDb = new Item();

$item = $ItemDb->getItemByUUID($_GET['uuid']);
$item = $item[0];
//print_r($item);

$ImageDb = new Image();
$itemPhotos = $ImageDb->getItemImages($_GET['uuid']);
//print_r($itemPhotos);

$favoriteImageUUID = $item['star_image'];

?>


<script>
function goBack() {
    window.location.href = "index.php";

}


function save() {
    var params = {
       "uuid" : document.getElementById('uuid').value,
       "name" : document.getElementById('name').value,
       "description": document.getElementById('description').value
    };
    
    console.log(params)

    $.ajax({
        type: "POST",
        url: 'api/updateItem.php',
        data: params,
        dataType: "json",
        success: function(data) {
            console.log(data);

            //window.location.href = 'index.php'
            
        }
    });
}

</script>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2><?php echo $item['name']; ?></h2>

                <div style="float:right;">
                    <div class="row">
                        <button class="btn btn-danger right-back" style="width: 80px;" onclick="goBack()">Go Back</button>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <button class="btn btn-primary right-back" style="width: 80px;" onclick="save()">Guardar</button>
                    </div>
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
                        <button class="btn btn-lg btn-warning btn-block" id="btnFavorite" formaction="starImage.php"><i class="far fa-star"></i>  Favorite </button>
                    </div>
                </div>';
            }

            echo $formSummit;

            ?>

        </form>

    </div>
</div>

<script>
    function imageSelected(uuidImage){
        console.log("Imatge amb uuid: " + uuidImage)



    }

</script>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
	        <?php
	        for ($i = 0; $i < sizeof($itemPhotos); $i++){
                $uuidImage =  $itemPhotos[$i]['uuid'];
                if ($favoriteImageUUID == $uuidImage) {
                    echo '
                    <div class="gallery favorite img-wrap">
                        <span class="close" onclick="deleteImage(\''.$uuidImage.'\')">&times;</span>
                        <!--<a onclick="imageSelected(\''.$uuidImage.'\')" href="javascript:void(0);">-->
                            <img src="images/'.$itemPhotos[$i]['url'].'" width="300" height="300" data-id="'.$uuidImage.'">
                        <!--</a>-->
                    </div>';
                } else {
	               echo '
    	            <div class="gallery img-wrap">
                        <span class="close" onclick="deleteImage(\''.$uuidImage.'\')">&times;</span>
    					<!--<a onclick="imageSelected(\''.$uuidImage.'\')" href="javascript:void(0);">-->
    					    <img src="images/'.$itemPhotos[$i]['url'].'" width="300" height="200" data-id="'.$uuidImage.'">
    				 	<!--</a>-->
    				</div>';
                }



	        }
	        ?>
	</div>
</div>

</body>
</html>