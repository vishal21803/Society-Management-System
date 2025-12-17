<?php 
include("connectdb.php");

$zone = $_POST['zone'];

$res = mysqli_query($con,"SELECT city_id,city_name 
                          FROM sens_cities 
                          WHERE zone_id='$zone'");

while($r = mysqli_fetch_assoc($res)){
    echo "<option value='{$r['city_id']}'>{$r['city_name']}</option>";
}
?>
