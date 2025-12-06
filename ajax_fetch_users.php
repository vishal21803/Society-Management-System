<?php
include("connectdb.php");

$search = $_POST['search'] ?? '';
$zone   = $_POST['zone'] ?? '';
$city   = $_POST['city'] ?? '';
$alpha  = $_POST['alpha'] ?? '';

$query = "SELECT m.*, u.name, u.email, z.zone_name, c.city_name 
          FROM members m
          JOIN users u ON m.user_id=u.id
          LEFT JOIN zones z ON m.zone_id=z.zone_id
          LEFT JOIN cities c ON m.city_id=c.city_id
          WHERE 1 ";

if($search!=""){
    $query .= " AND (m.fullname LIKE '%$search%' OR u.name LIKE '%$search%')";
}

if($zone!=""){
    $query .= " AND m.zone_id='$zone'";
}

if($city!=""){
    $query .= " AND m.city_id='$city'";
}

if($alpha=="asc"){
    $query .= " ORDER BY m.fullname ASC";
}
elseif($alpha=="desc"){
    $query .= " ORDER BY m.fullname DESC";
}
else{
    $query .= " ORDER BY m.member_id DESC";
}

$rs = mysqli_query($con,$query);

if(mysqli_num_rows($rs)==0){
    echo "<div class='alert alert-danger'>No Users Found</div>";
    exit;
}
?>

<table class="table table-bordered table-hover">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Zone</th>
    <th>City</th>
    <th>Action</th>
</tr>
</thead>
<tbody>

<?php
$i=1;
while($row=mysqli_fetch_assoc($rs)){
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= $row['fullname'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['zone_name'] ?></td>
    <td><?= $row['city_name'] ?></td>
    <td>
        <button class="btn btn-warning btn-sm" onclick="editUser(<?= $row['user_id'] ?>)">
    Edit
</button>



            <button class="btn btn-sm btn-danger"
                onclick="deleteUser(<?= $row['member_id'] ?>)">
                Delete
            </button>
    </td>
</tr>
<?php } ?>

</tbody>
</table>
