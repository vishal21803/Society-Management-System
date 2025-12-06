<?php
include("connectdb.php");

$member_id = $_GET['member_id'];

$res = mysqli_query($con, "
    SELECT 
        m.*, 
        u.*, 
       
        z.zone_name,
        c.city_name
    FROM members m
    JOIN users u ON u.id = m.user_id
    JOIN zones z ON z.zone_id = m.zone_id
    JOIN cities c ON c.city_id = m.city_id
    WHERE m.member_id='$member_id'
");


$row = mysqli_fetch_array($res);
$age = date_diff(date_create($row['dob']), date_create('today'))->y;
?>

<div class="row">
    <div class="col-md-4 text-center">
        <img src="upload/member/<?php echo $row['photo']; ?>" class="img-fluid rounded mb-3">
    </div>
    <div class="col-md-8">
        <p><strong>Name:</strong> <?php echo $row['fullname']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Gender:</strong> <?php echo ucfirst($row['gender']); ?></p>
        <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
         <p><strong>Zone:</strong> <?php echo $row['zone_name']; ?></p>
         <p><strong>City:</strong> <?php echo $row['city_name']; ?></p>
        <!-- <p><strong>Membership Start:</strong> <?php echo $row['membership_start']; ?></p>
        <p><strong>Membership End:</strong> <?php echo $row['membership_end']; ?></p> -->
    </div>
</div>
