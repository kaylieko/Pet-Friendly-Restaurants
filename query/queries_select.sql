/* select 'restaurant x state x type' */
/* Four Tables */
SELECT R.name, R.street, R.city, L.state, T.type, R.note
FROM restaurants R 
INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
INNER JOIN types T ON RT.type_id = T.t_id
INNER JOIN locations L ON R.location_id = L.l_id;

/* select 'restaurant x type' */
/* Three tables */
SELECT R.name, R.street, R.city, T.type, R.note 
FROM restaurants R 
INNER JOIN restaurant_type RT ON R.r_id = RT.rest_id
INNER JOIN types T ON RT.type_id = T.t_id;


/* select 'restaurant x state(location)' */
/* Two Tables */
SELECT R.name, R.street, R.city, L.state, R.note
FROM restaurants R, locations L
WHERE L.l_id = R.location_id
GROUP BY R.name;


 <?php
                        $sql = "SELECT state, state_code FROM locations ORDER BY state";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_array($result)){
                            echo "<option value = '" . $row[''] . "'>" . $row['state'] .", " . $row ['state_code'] ."</option>";
                        }
                        echo "</select>";
                ?>