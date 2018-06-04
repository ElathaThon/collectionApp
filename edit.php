<?php 
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
$item = $op->getItemByUUID($_POST['uuid']);
$item = $item[0];
//print_r($item);

$itemPhotos = $op->getItemImages($_POST['uuid']);
//print_r($itemPhotos)

$favoriteImageUUID = $item['star_image'];

?>


<script>
function goBack() {
    window.location.href = "index.php";

}
</script>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2><?php echo $item['name']; ?></h2>




        <form role="form" method="POST" id="editItem_form">
            <div class="row">

                <div style="float:right;">
                    <div class="row">
                        <button class="btn btn-danger right-back" style="width: 80px;" onclick="goBack()">Go Back</button>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <button class="btn btn-primary right-back" style="width: 80px;" formaction="api/updateItem.php"">Save</button>
                    </div>
                </div>

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
            
        </form>

    </div>
</div>


<div class="row">
    <div class="col-md-6 col-md-offset-3">
            <?php
            for ($i = 0; $i < sizeof($itemPhotos); $i++){

                if ($favoriteImageUUID == $itemPhotos[$i]['uuid']) {
                    echo '
                    <div class="gallery favorite">
                        <a target="_blank" href="images/'.$itemPhotos[$i]['url'].'">
                            <img src="images/'.$itemPhotos[$i]['url'].'" alt="itemImage" width="300" height="300">
                        </a>
                    </div>';
                
                } else {
                   echo '
                    <div class="gallery">
                        <a target="_blank" href="images/'.$itemPhotos[$i]['url'].'">
                            <img src="images/'.$itemPhotos[$i]['url'].'" alt="itemImage" width="300" height="200">
                        </a>
                    </div>';
                }



            }
            ?>
    </div>
</div>


</body>
</html>