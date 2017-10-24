<!-- Database Connection -->
<?php
ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","kohy-db","PmRjjTyVsSqvsT9b","kohy-db");
	if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!-- Restaurant Search Result Page -->
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
                ?>
                </select>   
                    <!-- Search Button -->
                <button type="submit" class="search-button">Search</button>
                </div>
             </form>
             
             
             <br><br>       
             <table class = "tableStyle">
                 <thead>
                 <tr>
                     <th>Name</th>
                     <th>Address</th>
                     <th>City</th>
                     <th>State</th>
                     <th>Type</th>
                     <th>Price</th>
                 </tr> 
                 </thead>
                 
            
               <?php
                 
                    /* display results by state */
                    if (($_GET["restaurants_locations"]!="Select the State") 
                        && ($_GET["restaurants_types"]=="Select Restaurant Type")){
                        $loc_str = $_GET['restaurants_locations'];
                        $loc_pieces = explode (", ", $loc_str);
                        $loc_state = trim($loc_pieces[0]);
                        echo "<h4>Showing all Pet-Friendly Restaurants in $loc_state. </h4>";

                        $query = "SELECT R.name, R.street, R.city, L.state, GROUP_CONCAT(T.type) AS type, PR.price
                                FROM restaurants R        
                                INNER JOIN priceRanges PR ON PR.pr_id = R.price_id
                                INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
                                INNER JOIN types T ON RT.type_id = T.t_id
                                INNER JOIN locations L ON R.location_id = L.l_id 
                                WHERE L.state = '". $loc_state ."'
                                GROUP BY R.name";
                        
                        
                        $result = mysqli_query($mysqli, $query);
                        while ($row = mysqli_fetch_array($result)) { 
                            print "<tr>"; 
                            print "<td><a href=restaurantInfo.php?res_data=". urlencode($row['name']) .">" . $row['name'] . "</a></td>"; 
                            print "<td>" . $row['street'] . "</td>"; 
                            print "<td>" . $row['city'] . "</td>"; 
                            print "<td>" . $row['state'] . "</td>";
                            print "<td>" . $row['type'] . "</td>";
                            print "<td>" . $row['price'] . "</td>";
                            print "</tr>"; 
                        } 
                    } 
                 
                    /* display results by type */
                    else if (($_GET["restaurants_locations"] =="Select the State") 
                        && ($_GET["restaurants_types"]!="Select Restaurant Type")){
                        $type_str = $_GET['restaurants_types'];
                        echo "<h4>Showing all ' $type_str ' type of Pet-Friendly Restaurants. </h4>";
                        
                        $query = "SELECT R.name, R.street, R.city, L.state, T.type, PR.price
                                FROM restaurants R 
                                INNER JOIN priceRanges PR ON PR.pr_id = R.price_id
                                INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
                                INNER JOIN types T ON RT.type_id = T.t_id
                                INNER JOIN locations L ON R.location_id = L.l_id
                                WHERE T.type = '". $type_str ."'
                                GROUP BY R.name";
                        
                        $result = mysqli_query($mysqli, $query); 
                        while ($row = mysqli_fetch_array($result)) { 
                            print "<tr>"; 
                            print "<td><a href=restaurantInfo.php?res_data=". urlencode($row['name']) .">" . $row['name'] . "</a></td>";                     
                            print "<td>" . $row['street'] . "</td>"; 
                            print "<td>" . $row['city'] . "</td>"; 
                            print "<td>" . $row['state'] . "</td>";
                            print "<td>" . $row['type'] . "</td>";
                            print "<td>" . $row['price'] . "</td>";
                            print "</tr>"; 
                        } 
                    } 
                 
                 
                    /* show all restaurants */
                    else if (($_GET["restaurants_locations"]=="Select the State")
                        && ($_GET["restaurants_types"]=="Select Restaurant Type")){
                        $query = "SELECT R.name, R.street, R.city, L.state, GROUP_CONCAT(T.type) AS type, PR.price
                                FROM restaurants R 
                                INNER JOIN priceRanges PR ON PR.pr_id = R.price_id
                                INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
                                INNER JOIN types T ON RT.type_id = T.t_id
                                INNER JOIN locations L ON R.location_id = L.l_id
                                GROUP BY R.name";
                        
                        $result = mysqli_query($mysqli, $query);
                        while ($row = mysqli_fetch_array($result)){
                            print "<tr>"; 
                            print "<td><a href=restaurantInfo.php?res_data=". urlencode($row['name']) .">" . $row['name'] . "</a></td>"; 
                            print "<td>" . $row['street'] . "</td>"; 
                            print "<td>" . $row['city'] . "</td>"; 
                            print "<td>" . $row['state'] . "</td>";
                            print "<td>" . $row['type'] . "</td>";
                            print "<td>" . $row['price'] . "</td>";
                            print "</tr>"; 
                        }
                    }
                 
                    /* display results by state & type */
                    else {
                        $loc_str = $_GET['restaurants_locations'];
                        $loc_pieces = explode (", ", $loc_str);
                        $loc_state = trim($loc_pieces[0]);
                        $type_str = $_GET['restaurants_types'];
                        echo "<h4>Showing all ' $type_str ' type of Pet-Friendly Restaurants in $loc_state. </h4>";

                        $query = "SELECT R.name, R.street, R.city, L.state, GROUP_CONCAT(T.type) AS type, PR.price
                                FROM restaurants R 
                                INNER JOIN priceRanges PR ON PR.pr_id = R.price_id
                                INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
                                INNER JOIN types T ON RT.type_id = T.t_id
                                INNER JOIN locations L ON R.location_id = L.l_id
                                WHERE type = '". $type_str ."' AND L.state = '". $loc_state ."'
                                GROUP BY R.name";
                     
                        $result = mysqli_query($mysqli, $query); 
                        while ($row = mysqli_fetch_array($result)) { 
                            print "<tr>"; 
                            print "<td><a href=restaurantInfo.php?res_data=". urlencode($row['name']) .">" . $row['name'] . "</a></td>"; 
                            print "<td>" . $row['street'] . "</td>"; 
                            print "<td>" . $row['city'] . "</td>"; 
                            print "<td>" . $row['state'] . "</td>";
                            print "<td>" . $row['type'] . "</td>";
                            print "<td>" . $row['price'] . "</td>";
                            print "</tr>"; 
                        } 
                 }
            ?>
             </table>
         
         </div>
    </body>
</html>