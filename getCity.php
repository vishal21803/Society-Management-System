<?php
include("connectdb.php");

$zone_id = $_GET['zone_id'];

$res = mysqli_query($con, "SELECT * FROM sens_cities WHERE zone_id = '$zone_id' AND cstatus=1 ORDER BY city_name ASC");

while($row = mysqli_fetch_array($res)){
    echo "<option value='{$row['city_id']}'>{$row['city_name']}</option>";
}
?>
