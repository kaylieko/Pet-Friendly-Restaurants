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
            
                    /*If link clicked from restaurantInfo page 'Update' */
                    if(isset($_GET['res_update'])){ 
                       $res_str = $_GET['res_update'];
                    
                        $query = "SELECT R.r_id, R.name, R.street, R.city, L.state, GROUP_CONCAT(T.type) AS type,                    R.note, R.photo, PR.price
                                FROM restaurants R 
                                INNER JOIN priceRanges PR ON PR.pr_id = R.price_id
                                INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
                                INNER JOIN types T ON RT.type_id = T.t_id
                                INNER JOIN locations L ON R.location_id = L.l_id
                                WHERE R.name = '". $res_str ."'";
                        
                        $result = mysqli_query($mysqli, $query); 
                        $info = mysqli_fetch_assoc($result);
                    }
                ?>
            
               <!-- Update Restaurants -->
             <div style = "width: 800px;"> 
                  <div class = "header" > 
                    <?php echo $info['name']; ?>
                </div>
                 <form method="POST" action="updateAction.php"> 

                    <fieldset id ="addFormOut2">
                    <legend style = "font-size: 120%; color: #7CC4C2;">Update the Restaurant</legend>
                        
                    <fieldset id="addFormIn">
                        
                        <p>
                            <label>Address:  </label><input type="text" name="update_street" style="width: 308px;" />
                            <label>City:  </label><input type="text" name="update_city" style ="width: 200px;"/>
                            
                        </p>
                        <p>
                        <label>Description:  </label> 
                        <input type="text" name="update_note" style="width:530px; height: 40px;"/>
                        </p>
                        <label>Add Type(s): </label>
                            <select name = 'edit_type[]' multiple = "multiple">;
                            <option selected>Select Restaurant Type</option>
                            <?php
                                $sql = "SELECT t_id, type FROM types ORDER BY type";
                                $result = mysqli_query($mysqli, $sql);
                                while ($row = mysqli_fetch_array($result)){
                                    echo "<option value = '" . $row['t_id'] . "'>" . $row['type'] ."</option>";
                                }
                            ?>
                            </select>
                            <font style = "font-size: 80%;">
                            ('Ctrl + Click' for multiple selection / Scroll down for more options)</font>
                    </fieldset>
                    <input type="hidden" name ="update_id" value="<?php echo $info['r_id'] ?>">
                     
                    <input type="submit" id = "update_submit" value ="Update Restaurant" />

                    </fieldset>
                </form>
            </div>
          
        </div>
    </body>
</html>