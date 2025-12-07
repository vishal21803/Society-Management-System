
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
 include("connectdb.php");

?>

<main>
<div class="d-flex">
    <?php include('adminDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container-fluid">

    <!-- ✅ Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded shadow bg-warning text-dark">
                <h2 class="fw-bold mb-1">👋 Welcome Back, Admin!</h2>
                <p class="mb-0">Manage your website, users, members and content from here.</p>
            </div>
        </div>
    </div>

    <!-- ✅ Quick Info Cards -->
    <div class="row g-4 mb-4">

      
        <div class="col-md-12">
            <div class="card shadow text-center border-0">
                <div class="card-body">
                    <h3 class="fw-bold text-success">
                        <?php 
                        echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM sens_members")); 
                        ?>
                    </h3>
                    <p class="mb-0">Total Members</p>
                </div>
            </div>
        </div>

       

    </div>

    <!-- ✅ Admin Message Box -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white fw-bold">
                    📢 Admin Message
                </div>
                <div class="card-body">
                    <p>
                        Welcome to the Admin Dashboard. From here you can:
                    </p>
                    <ul>
                        <li>✅ Add & Manage Members</li>
                        <li>✅ Approve Membership Requests</li>
                        <li>✅ Manage Gallery, News & Events</li>
                        <li>✅ View Transactions & Reports</li>
                        <li>✅ Handle User Messages</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ✅ Date & Time Card -->
        <div class="col-md-4">
            <div class="card shadow border-0 text-center">
                <div class="card-header bg-primary text-white fw-bold">
                    📅 Today
                </div>
                <div class="card-body">
                    <h4 class="fw-bold"><?= date("d M Y") ?></h4>
                    <h5 id="clock" class="text-muted"></h5>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ✅ Live Clock Script -->
<script>
function updateClock(){
    let now = new Date();
    let time = now.toLocaleTimeString();
    document.getElementById("clock").innerText = time;
}
setInterval(updateClock,1000);
updateClock();
</script>

    </div>
</div>

</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
