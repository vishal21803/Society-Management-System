<?php
include("connectdb.php");

$state_id = $_GET['state_id'];

$res = mysqli_query($con, "SELECT * FROM zones WHERE state_id = '$state_id' ORDER BY zone_name ASC");

while($row = mysqli_fetch_array($res)){
    echo "<option value='{$row['zone_id']}'>{$row['zone_name']}</option>";
}
?>
