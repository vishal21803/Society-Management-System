<?php
include("connectdb.php");
$zone_id = $_POST['zone_id'];

$res=mysqli_query($con,"SELECT * FROM sens_cities WHERE zone_id='$zone_id' AND cstatus=1");

echo "<option value=''>Select City</option>";
while($row=mysqli_fetch_assoc($res)){
  echo "<option value='{$row['city_id']}'>{$row['city_name']}</option>";
}
?>
