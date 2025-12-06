<?php
include("connectdb.php");

$zone_id = $_POST['zone_id'];

echo "<option value=''>All Cities</option>";

$q = mysqli_query($con,"SELECT * FROM cities WHERE zone_id='$zone_id'");
while($row = mysqli_fetch_assoc($q)){
    echo "<option value='{$row['city_id']}'>{$row['city_name']}</option>";
}
?>
