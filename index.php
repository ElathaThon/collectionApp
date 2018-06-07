<?php 
session_start();

require_once ('core/Ini.php');
require_once('core/settings.php');

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>

<!DOCTYPE html>
<html>
<head>
	<title>New item</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="css/main.css" >
<link rel="stylesheet" href="css/googleLoginButton.css" >

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Controller de la llista de elemts que tenim -->
<script src="js/listItems_controller.js"></script>

<!-- Controller del form de new item -->
<script src="js/newItemForm_controller.js"></script>

</head>
<body onLoad="loadList()">


<?php 
if (false) {
    $op = new Connection();
    echo "<pre>Test connection to DDBB:";
    print_r($op->getAllItems());
    echo "</pre>";
}
?>

<!--<a href="<?= $login_url ?>">Login with Google</a>-->

<div class="col-md-6 col-md-offset-3">

    <div class="omb_login pull-right">
    <div class="row omb_row-sm-offset-3 omb_socialButtons">
            <a href="<?= $login_url ?>" class="btn btn-lg btn-block omb_btn-google">
                <i class="fa fa-google-plus visible-xs"></i>
                <span class="hidden-xs">Login Google+ <i class="fab fa-google-plus"></i></span>
            </a>
        </div>
    </div>

    <h2>Items creats actualment</h2>
    
    <ul class="list-group" id="listItems">

    </ul>
</div>

<div class="col-md-6 col-md-offset-3"><hr class="style11"></div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h1><?php echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?></h1>

        <h2>New item</h2>
        <p>Crear un nou item</p>
        <form role="form" method="POST" id="newItem_form">
            <div class="row">

            	<div class="col-sm-6 form-group">
                    <label for="name">
                        Name:</label>
                    <input type="text" class="form-control" id="name" name="name"  maxlength="50" required>
                </div>

                <div class="col-sm-12 form-group">
                    <label for="name">
                        Description:</label>
                    <textarea class="form-control" type="textarea" id="description" name="description" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">New one!</button>
                </div>
            </div>

        </form>

    </div>
</div>


</body>
</html>



