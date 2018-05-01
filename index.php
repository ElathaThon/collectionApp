<?php 
require_once ('core/Ini.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>New item</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Controller del form de new item -->
<script src="newItemForm_controller.js"></script>

</head>
<body>


<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>New item</h2>
        <p>Crear un nou item</p>
        <form role="form" method="POST" id="newItem_form">
            <div class="row">

            	<div class="col-sm-6 form-group">
                    <label for="name">
                        Name:</label>
                    <input type="text" class="form-control" id="name" name="name"  maxlength="50">
                </div>

                <div class="col-sm-12 form-group">
                    <label for="name">
                        Description:</label>
                    <textarea class="form-control" type="textarea" id="description" name="description" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Post It!</button>
                </div>
            </div>

        </form>

    </div>
</div>


</body>
</html>



