<!-- Database Connection -->
<?php
ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","kohy-db","PmRjjTyVsSqvsT9b","kohy-db");
	if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!-- Restaurant Main Page -->
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
    
    <body background = "image/bg_green.jpg" > 
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
            <h1>Find Pet-Friendly Restaurants</h1>
            <p style ="font-size: 120%;">
                Please use the search parameters below to view the pet-friendly restaurants in the database.<br>
                Or, click 'Search' button without using advanced filters <br>
                to get all the pet-friendly restaurants contained in the database.
            </p>
            
            <!-- Restaurant Database From -->
            <form class="form-inline" action="showRestaurant.php" method="GET">
            
                <!-- Select Location Drop-Down box -->
                <div>
                <select name = 'restaurants_locations'>;
                <option selected>Select the State</option>
                <?php
                        $sql = "SELECT state, state_code FROM locations ORDER BY state";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_array($result)){
                            echo "<option value = '" . $row['state'] . "'>" . $row['state'] .", " . $row ['state_code'] ."</option>";
                        }
                        echo "</select>";
                ?>
                </select>   
                    
                <!-- Select Type Drop-Down box -->
                <select name = 'restaurants_types'>;
                <option selected>Select Restaurant Type</option>
                <?php
                        $sql = "SELECT type FROM types ORDER BY type";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_array($result)){
                            echo "<option value = '" . $row['type'] . "'>" . $row['type'] ."</option>";
                        }
                        echo "</select>";
                ?>
                </select>  
                    
                    
                <!-- Search Button -->
                <button type="submit" class="search-button">Search</button>
                </div>
            </form>
            <br><br>
            
            <?php
                    /* Get the information from updateRestaurant.php page */
                    $up_id = $_POST['update_id'];           //int
                    $up_street = $_POST['update_street'];   //string
                    $up_city = $_POST['update_city'];       //string
                    $up_note = $_POST['update_note'];       //string
            
                    /* Update the restaurant (street, city, note only)*/
                    $query = $mysqli->prepare("Update restaurants SET street = ?, city = ?, note = ? WHERE r_id = ?");
                    $query->bind_param ('sssi', $up_street, $up_city, $up_note, $up_id);
                    $query->execute();
                   
                    if(isset($_POST['edit_type'])){
                    $edit_type = implode(',', (array)$_POST['edit_type']);
                    
                    /* Add restaurant type info */
                    foreach((array)$_POST['edit_type'] as $edit_type){
                        $temp_query = <<< stmt
                            SELECT t_id FROM types WHERE types.t_id = ?;
stmt;
                        $stmt_3 = $mysqli->prepare($temp_query);
                        $stmt_3->bind_param('i', $edit_type);
                        $stmt_3->execute();
                        $stmt_3->bind_result($new_T_id);
                        $stmt_3->fetch();
                        $stmt_3->close();
                        
                        $temp_query_2 = <<<stmt
                        INSERT INTO restaurant_type (rest_id, type_id) VALUES (?,?);
stmt;
                        $stmt_4 = $mysqli->prepare($temp_query_2);
                        $stmt_4->bind_param('ii',  $up_id, $new_T_id);
                        $stmt_4->execute();
                        //$stmt_4->close();
                    }
                    }
                    if (($query->affected_rows > 0) || ($stmt_4->affected_rows > 0)){
                        echo /* Display when it's successfully updated */
                            "<h2>Restaurant successfully updated in the database. 
                            <br>Thanks for contributing to the database!</h2>" ;                   
                    }
                    else {
                        echo "Nothing happened. Try again";
                    }   
                  
            ?>
        </div>
    </body>
</html>