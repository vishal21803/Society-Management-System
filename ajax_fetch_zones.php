<?php
include("connectdb.php");

$search = $_POST['search'];
$sort   = $_POST['sort'];

$sql = "SELECT * FROM sens_zones WHERE zone_name LIKE '%$search%'";

if($sort == "asc"){
    $sql .= " ORDER BY zone_name ASC";
}
elseif($sort == "desc"){
    $sql .= " ORDER BY zone_name DESC";
}

$res = mysqli_query($con, $sql);

$i=1;
while($z = mysqli_fetch_assoc($res)){
?>
<tr id="zoneRow<?= $z['zone_id'] ?>">
    <td><?= $i++ ?></td>
    <td><?= $z['zone_name'] ?></td>
    <td>
        <button class="btn btn-sm btn-success"
            onclick="editZone(<?= $z['zone_id'] ?>,'<?= $z['zone_name'] ?>')">
            Edit
        </button>

        <button class="btn btn-sm btn-danger"
            onclick="deleteZone(<?= $z['zone_id'] ?>)">
            Delete
        </button>
    </td>
</tr>
<?php } ?>
