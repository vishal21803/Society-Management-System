<?php
include("connectdb.php");

$search = $_POST['search'];
$zone   = $_POST['zone'];
$sort   = $_POST['sort'];

$sql = "
SELECT c.city_id, c.city_name, z.zone_name 
FROM cities c 
JOIN zones z ON c.zone_id = z.zone_id 
WHERE c.city_name LIKE '%$search%'
";

if($zone != ""){
    $sql .= " AND c.zone_id='$zone'";
}

if($sort == "asc"){
    $sql .= " ORDER BY c.city_name ASC";
}
elseif($sort == "desc"){
    $sql .= " ORDER BY c.city_name DESC";
}

$res = mysqli_query($con, $sql);

$i=1;
while($c = mysqli_fetch_assoc($res)){
?>
<tr id="cityRow<?= $c['city_id'] ?>">
    <td><?= $i++ ?></td>
    <td><?= $c['city_name'] ?></td>
    <td><?= $c['zone_name'] ?></td>
    <td>
        <button class="btn btn-sm btn-success"
            onclick="editCity(<?= $c['city_id'] ?>,'<?= $c['city_name'] ?>')">
            Edit
        </button>

        <button class="btn btn-sm btn-danger"
            onclick="deleteCity(<?= $c['city_id'] ?>)">
            Delete
        </button>
    </td>
</tr>
<?php } ?>
