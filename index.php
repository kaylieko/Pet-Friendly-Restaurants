<!-- Database Connection -->
<?php
ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","kohy-db","PmRjjTyVsSqvsT9b","kohy-db");
	if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pet Friendly Restaurants</title>
        <meta name="description" content="Database driven website">
        
        <!-- Font -->
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Quicksand|Raleway">
        
        <!-- CSS -->
        <link rel="stylesheet" href="style.css">
        
    </head>
    

    <body background = "image/bg.jpg">        
        <!-- Navigation Bar -->
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="restaurants.php">Restaurants</a></li>
            <li><a href="manage.php">Manage</a></li>
        </ul>
        
        <p style="position: fixed; top: 0; width:100%; margin-left: 60px">
        © 2017 By.Hyejin Ko
        </p>
    </body>
</html>

