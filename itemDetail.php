<?php 
require_once ('core/Ini.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Detall del item</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

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
print_r($item);
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2><?php echo $item['name']; ?></h2>
        <form role="form" method="POST" id="newImage_form">
            <div class="row">

            	<input disabled name="uuid" id="uuid" type="hidden" <?php echo "value='".$item["uuid"]."'"; ?>>

            	<div class="col-sm-6 form-group">
                    <label for="name">
                        Name:</label>
                    <input <?php echo "value='".$item["name"]."'"; ?> type="text" class="form-control" id="name" name="name"  maxlength="50">
                </div>

                <div class="col-sm-12 form-group">
                    <label for="name">
                        Description:</label>
                    <textarea <?php echo "placeholder='".$item["description"]."'"; ?> class="form-control" type="textarea" id="description" name="description" xplaceholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Afegir una imatge</button>
                </div>
            </div>

        </form>

    </div>
</div>


<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<div class="gallery">
			<a target="_blank" href="fjords.jpg">
			    <img src="fjords.jpg" alt="Fjords" width="300" height="200">
		 	</a>
		 	<div class="desc">Add a description of the image here</div>
		</div>

	</div>
</div>


</body>
</html>