<?php
include("connectdb.php");

$search = $_POST['search'] ?? "";
$alpha  = $_POST['alpha']  ?? "";   // A-Z / Z-A
$sortBy = $_POST['sortBy'] ?? "";   // name / username / member_id

$sql = "
SELECT u.id, u.name, m.member_id, m.fullname
FROM users u
JOIN members m ON u.id = m.user_id
WHERE u.name LIKE '%$search%' 
OR m.fullname LIKE '%$search%'
";

/* ===========================
   ✅ SORTING LOGIC
=========================== */

if($sortBy == "name"){
    $sql .= " ORDER BY m.fullname $alpha";
}
elseif($sortBy == "username"){
    $sql .= " ORDER BY u.name $alpha";
}
elseif($sortBy == "member"){
    $sql .= " ORDER BY m.member_id $alpha";
}
else{
    $sql .= " ORDER BY m.member_id DESC"; // Default
}

$q = mysqli_query($con,$sql);

echo "<table class='table table-bordered table-hover'>";
echo "<tr class='table-warning'>
<th>Full Name</th>
<th>Username</th>
<th>Member ID</th>
<th>Action</th>
</tr>";

if(mysqli_num_rows($q)==0){
    echo "<tr><td colspan='4' class='text-center text-danger'>No Record Found</td></tr>";
}

while($row = mysqli_fetch_assoc($q)){
    echo "<tr>
        <td>{$row['fullname']}</td>
        <td>{$row['name']}</td>
        <td>{$row['member_id']}</td>
        <td>
            <button class='btn btn-sm btn-info'
            onclick='openModal(\"view-history\", {$row['member_id']})'>
            View History</button>

            <button class='btn btn-sm btn-success'
            onclick='openModal(\"bill-form\", {$row['member_id']})'>
            Insert Bill</button>
        </td>
    </tr>";
}
echo "</table>";
?>
