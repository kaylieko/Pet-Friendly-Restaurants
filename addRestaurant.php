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
            <h1>Add the Database</h1>
            <p style ="font-size: 120%;">
                You can add pet-friendly restaurants here.
            </p>  
            <br><br>
             
            <?php
     
                /* check if same restaurant name already exists */           
                $init_query = <<<stmt
                            SELECT r_id FROM restaurants WHERE restaurants.name = ?;
stmt;
                $i_stmt = $mysqli->prepare($init_query);
                $i_stmt->bind_param('s', $_POST['add_name']);
                $i_stmt->execute();
                $i_stmt->store_result();
                $i_stmt->bind_result($i_id);
                $i_num_rows = $i_stmt->num_rows;
                $r_name = $_POST['add_name'];
                if ($i_num_rows > 0) {
                    echo <<<res
                        <h2>Restaurant '$r_name' already exists in the database. 
                        <br>... Sorry, we only accept new submissions.</h2>
res;
                    exit();
                } else { 
                    
                    /* Get the information from manage.php page */
                    $r_street = $_POST['add_street'];   //string
                    $r_city = $_POST['add_city'];       //string
                    $r_state = $_POST['add_state'];     //int(l_id)
                    $r_note = $_POST['add_note'];       //string
                    $r_price = $_POST['add_price'];     //int

                    /* Add new restaurant (except photo, type yet)*/
                    /* Reference from http://php.net/manual/en/mysqli-stmt.bind-result.php */
                    $sec_query = <<< stmt
                    INSERT INTO restaurants (name, street, city, location_id, note, price_id) VALUES (?,?,?,?,?,?);
stmt;
                    $stmt_2 = $mysqli->prepare($sec_query);
                    $stmt_2->bind_param ('sssisi', $_POST['add_name'], $r_street, $r_city, $r_state, $r_note, $r_price);
                    $stmt_2->execute();
                    $new_R_id = $stmt_2->insert_id;
                    
                    /* Reference from https://stackoverflow.com/questions/11922130/how-to-store-multiple-selected-values-from-select-tag-in-a-single-field */
                    $r_type = implode(',', (array)$_POST['add_type']);
                    
                    /* Add restaurant type info */
                    foreach((array)$_POST['add_type'] as $r_type){
                        $temp_query = <<< stmt
                            SELECT t_id FROM types WHERE types.t_id = ?;
stmt;
                        $stmt_3 = $mysqli->prepare($temp_query);
                        $stmt_3->bind_param('i', $r_type);
                        $stmt_3->execute();
                        $stmt_3->bind_result($new_T_id);
                        $stmt_3->fetch();
                        $stmt_3->close();
                        
                        $temp_query_2 = <<<stmt
                        INSERT INTO restaurant_type (rest_id, type_id) VALUES (?,?);
stmt;
                        $stmt_4 = $mysqli->prepare($temp_query_2);
                        $stmt_4->bind_param('ii',  $new_R_id, $new_T_id);
                        $stmt_4->execute();
                        $stmt_4->close();
                    }
                    
                      if(isset($_FILES['add_photo'])){
                       $uploadDir = 'uploads/';
                        
                        $fileName = basename($_FILES['add_photo']['name']);
                        $tmpName = $_FILES['add_photo']['tmp_name'];
                        $imgSize = $_FILES['add_photo']['size'];
                        $imgType = $_FILES['add_photo']['type'];
                        
                        $filePath = $uploadDir . $fileName;
                        move_uploaded_file($tmpName, $filePath);

                        $sql = "UPDATE restaurants SET photo =  '$filePath'  WHERE r_id = $new_R_id";
                        $result = $mysqli->query($sql);
                        if(!$result){
                              printf("error: %s\n", mysqli_error($mysqli));
                        }
                      }
             
                    /* Display when it's successfully added */
                    if($new_R_id){     
                        echo <<<res
                        <h2>Restaurant '$r_name' successfully added in the database. 
                        <br>Thanks for contributing to the database!</h2>                   
res;
                    }else {             /* Error message, when the data wasn't successfully added */
                        echo <<<res
                        <h2> Error! <br> You need to fill out all of the *red colored sections.
res;
                    }
                }
             ?>
         </div>
    </body>
</html>
