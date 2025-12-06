
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

$uid = $_SESSION['member_id'];

$q = mysqli_query($con,"
    SELECT 
        -- REQUEST DATA
        r.request_id,
        r.status AS request_status,
        r.request_date,
        r.approved_date,

        -- MEMBER DATA
        m.member_id,
        m.user_id,
        m.zone_id,
        m.city_id,
        m.plan_id,
        m.gender,
        m.dob,
        m.membership_start,
        m.membership_end,
        m.phone,
        m.address,
        m.photo,
        m.created_at,
        m.fullname,

        -- USER DATA
        u.id,
        u.name,
        u.email,
        u.role,
        u.onboarding,
        

        -- ZONE & CITY NAMES
        z.zone_name,
        c.city_name

    FROM requests r
    JOIN members m ON r.member_id = m.member_id
    JOIN users u ON m.user_id = u.id
    JOIN zones z ON m.zone_id = z.zone_id
    JOIN cities c ON m.city_id = c.city_id

    WHERE r.member_id = '$uid'
");

$user = mysqli_fetch_assoc($q);

$status = $user['request_status']; // pending / approved / rejected

?>

<main>
<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- COVER -->
                <div class="bg-warning p-4 text-center">
                    <img src="upload/member/<?php echo $user['photo']; ?>" 
                         class="rounded-circle border border-4 border-white"
                         width="140" height="140">
                    <h4 class="mt-3 mb-0 text-dark fw-bold">
                        <?php echo $user['fullname']; ?>
                    </h4>

                    <?php if($status=="approved"){ ?>
                        <span class="badge bg-success mt-2 px-3 py-2 fs-6">
                            <i class="bi bi-patch-check-fill"></i> Verified
                        </span>
                    <?php } else if($status=="pending") { ?>
                        <span class="badge bg-danger mt-2 px-3 py-2 fs-6">
                            ⏳ Approval Pending
                        </span>
                    <?php } ?>
                </div>

                <!-- BODY -->
                <div class="card-body bg-light">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Email</p>
                            <div class="form-control bg-white">
                                <?php echo $user['email']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Mobile</p>
                            <div class="form-control bg-white">
                                <?php echo $user['phone']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">City</p>
                            <div class="form-control bg-white">
                                <?php echo $user['city_name']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Zone</p>
                            <div class="form-control bg-white">
                                <?php echo $user['zone_name']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Address</p>
                            <div class="form-control bg-white">
                                <?php echo $user['address']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Registration Date</p>
                            <div class="form-control bg-white">
                                <?php echo date("d M Y",strtotime($user['created_at'])); ?>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="card-footer bg-white text-center">
                    <a href="edit-profile.php" class="btn btn-warning px-4">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

    </div>
</div>
</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
