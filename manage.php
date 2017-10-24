<!-- Database Connection -->
<?php
ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","kohy-db","PmRjjTyVsSqvsT9b","kohy-db");
	if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!-- Manage Main Page -->
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
            <h1>Manage the Database</h1>
             <p style ="font-size: 120%;">
                You can add or delete a restaurant.
            </p><br>
             <!-- Add Restaurants -->
             <div style = "width: 750px;">  
                 <form method="POST" action="addRestaurant.php" enctype="multipart/form-data"> 

                    <fieldset id ="addFormOut">
                    <legend style = "font-size: 120%; color: #9b4865;">Add Pet-Friendly Restaurants</legend>
                        
                    <fieldset id="addFormIn">
                        <font color = "red" size = "2">*red colored sections should be filled with the information.</font>
                        <p>
                            <label class='required'><span class='red'>*Restaurant Name:  </span></label> 
                            <input type="text" name="add_name" style ="width: 300px;"/> 
                            <label class='required'><span class='red'>*Price Range:  </span></label>
                            <select name = 'add_price'>;
                                <option selected>Select the Price</option>
                                <?php
                                    $sql = "SELECT pr_id, price FROM priceRanges ORDER BY pr_id";
                                    $result = mysqli_query($mysqli, $sql);
                                    while ($row = mysqli_fetch_array($result)){
                                        echo "<option value = '" . $row['pr_id'] . "'>" . $row['price'] ."</option>";
                                    }
                                ?>
                            </select>
                        </p>
                        
                        <p>
                            <label>Address:  </label><input type="text" name="add_street" style="width: 200px;" />
                            <label>City:  </label><input type="text" name="add_city" />
                            <label class='required'><span class='red'>*State:  </span></label>
                            <select name = 'add_state'>;
                                <option selected>Select the State</option>
                                <?php
                                    $sql = "SELECT l_id, state FROM locations ORDER BY state";
                                    $result = mysqli_query($mysqli, $sql);
                                    while ($row = mysqli_fetch_array($result)){
                                        echo "<option value = '" . $row['l_id'] . "'>" . $row['state'] ."</option>";
                                    }
                                ?>
                            </select>
                        </p>
                        <p>
                        <label>Description:  </label> 
                        <input type="text" name="add_note" style="width:530px; height: 40px;"/>
                        </p>
                        <p>
                            <label class='required'><span class='red'>*Type: </span></label>
                            <select name = 'add_type[]' multiple = "multiple">;
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
                        </p>
                         <p>
                        <label> Upload a Photo:  </label>
                        <input type = "file" name ="add_photo" />
                        </p>

                        </fieldset>
                        <input type="submit" id = "add_button" value ="Add Retaurant"/>

                    </fieldset>
                </form>
            
                  <br>   
            <!-- Delete Restaurants -->
                <form method="POST" action="deleteRestaurant.php"> 
                    <fieldset id ="addFormOut">
                    <legend style = "font-size: 120%; color: #9b4865;">Delete Pet-Friendly Restaurant</legend>
                    
                    <fieldset id="addFormIn">
                        <p><label> Select Restaurant To Delete: </label>
                        <select name = 'delete_restaurant'>;
                            <option selected>Select Restaurant</option>
                            <?php
                                $sql = "SELECT name FROM restaurants ORDER BY name";
                                $result = mysqli_query($mysqli, $sql);
                                while ($row = mysqli_fetch_array($result)){
                                    echo "<option value = '" . $row['name'] . "'>" . $row['name'] ."</option>";
                                }
                            ?>
                        </select>
                        <input type="submit" id ="delete_button" value ="Delete" /></p>

                    </fieldset>
                    </fieldset>
                </form>
            </div>
         </div>
    </body>
</html>