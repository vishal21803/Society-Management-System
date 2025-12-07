<?php
include("connectdb.php");

$id = $_POST['id'];

$q = mysqli_query($con,"
SELECT u.id AS user_id, u.email, u.name AS uname, 
m.fullname, m.gender, m.dob, m.zone_id, m.city_id,m.address
FROM sens_users u 
JOIN sens_members m ON u.id = m.user_id
WHERE u.id='$id'
");

$data = mysqli_fetch_assoc($q);

/* Load Zones */
$zones = "";
$zq = mysqli_query($con,"SELECT * FROM sens_zones");
while($z = mysqli_fetch_assoc($zq)){
    $sel = ($z['zone_id']==$data['zone_id']) ? "selected" : "";
    $zones .= "<option value='{$z['zone_id']}' $sel>{$z['zone_name']}</option>";
}

/* Load Cities */
$cities = "";
$cq = mysqli_query($con,"SELECT * FROM sens_cities WHERE zone_id='{$data['zone_id']}'");
while($c = mysqli_fetch_assoc($cq)){
    $sel = ($c['city_id']==$data['city_id']) ? "selected" : "";
    $cities .= "<option value='{$c['city_id']}' $sel>{$c['city_name']}</option>";
}

$data['zoneOptions'] = $zones;
$data['cityOptions'] = $cities;

echo json_encode($data);
?>
