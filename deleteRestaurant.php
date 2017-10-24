<?php
ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","kohy-db","PmRjjTyVsSqvsT9b","kohy-db");
	if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!-- My List Main Page -->
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
    
     <body background = "image/bg_green.jpg"> 
         <div style="float:left; width:25%;">
            <!-- Navigation Bar -->
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="restaurants.php">Restaurants</a></li>
                <li><a href="manage.php">Manage</a></li>
            </ul>
         </div>
         
         <div style="float:left; width:75%;">
             <!-- Page Description -->
            <h1>Delete the Database</h1>
            <p style ="font-size: 120%;">
                You can delete pet-friendly restaurants here.
            </p>  
            
             <br><br>
         <?php
            
            $query = <<<stmt
                    DELETE FROM restaurants WHERE restaurants.name = ?;
stmt;
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('s', $_POST['delete_restaurant']);

            if ( !$stmt->execute() ) {
                echo <<<res
                    <h2>Something went wrong! Please try again.</h2>
res;
            } else {
                echo <<<res
                    <h2>The Restaurant was successfully deleted!</h2>
res;
            }
            $stmt->close();
        ?>
            
             
         </div>
    </body>
</html>