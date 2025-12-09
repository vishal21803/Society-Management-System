<?php
include("connectdb.php");

$member_id = $_POST['member_id'];
$request_id = $_POST['request_id'];

$q = mysqli_query($con,"
    SELECT m.*, 
           u.email, 
           m.phone,
           z.zone_name,
           c.city_name,
           p.name, 
           p.price
           
    FROM sens_members m
    JOIN sens_users u ON u.id = m.user_id
    LEFT JOIN sens_zones z ON z.zone_id = m.zone_id
    LEFT JOIN sens_cities c ON c.city_id = m.city_id
    LEFT JOIN sens_plans p ON p.plan_id = m.plan_id
    WHERE m.member_id = '$member_id'
");

$row = mysqli_fetch_assoc($q);
?>

<div class="row">

    <div class="col-md-4 text-center">
        <img src="upload/member/<?php echo $row['photo']; ?>" 
             style="width:150px;height:150px;border-radius:50%;object-fit:cover;">
        <h5 class="mt-3"><?php echo $row['fullname']; ?></h5>
    </div>

    <div class="col-md-8">

        <table class="table table-bordered">
            <tr>
                <th>City</th>
                <td><?php echo $row['city_name']; ?></td>
            </tr>
            <tr>
                <th>Zone</th>
                <td><?php echo $row['zone_name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $row['phone']; ?></td>
            </tr>
            <tr>
                <th>Membership Plan</th>
                <td>
                    <?php echo $row['name']; ?> 
                    (₹<?php echo $row['price']; ?>)
                </td>
            </tr>
        </table>

    </div>

</div>
