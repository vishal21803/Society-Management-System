
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
?>

<main>
<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <?php
$uid = $_SESSION['uid'] ?? 0;
$member_id = $_SESSION['member_id'] ?? 0;

// ✅ Get user name
$userName = "User";
if($uid){
    include("connectdb.php");
    $u = mysqli_fetch_assoc(mysqli_query($con,"SELECT name FROM users WHERE id='$uid'"));
    $userName = $u['name'];
}

// ✅ Membership Status
// ✅ Membership Status (SAFE VERSION)
$statusText = "Not Active";
$statusColor = "danger";

if($member_id){
    $m = mysqli_fetch_assoc(mysqli_query($con,"SELECT membership_end FROM members WHERE member_id='$member_id'"));

    if(!empty($m['membership_end'])){   // ✅ NULL check added
        $end = strtotime($m['membership_end']);

        if($end !== false && $end >= time()){
            $statusText = "Active";
            $statusColor = "success";
        }
    }
}

?>

<div class="container-fluid">

    <!-- ✅ Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded shadow bg-success text-white">
                <h2 class="fw-bold mb-1">👋 Welcome, <?= htmlspecialchars($userName) ?>!</h2>
                <p class="mb-0">Here’s your personal dashboard.</p>
            </div>
        </div>
    </div>

    <!-- ✅ Status + Quick Links -->
    <div class="row g-4 mb-4">

        <!-- ✅ Membership Status -->
        <div class="col-md-4">
            <div class="card shadow text-center border-0">
                <div class="card-body">
                    <h5 class="fw-bold">Membership Status</h5>
                    <span class="badge bg-<?= $statusColor ?> fs-6 px-3 py-2">
                        <?= $statusText ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- ✅ My Messages -->
        <div class="col-md-4">
            <div class="card shadow text-center border-0">
                <div class="card-body">
                    <h5 class="fw-bold">My Messages</h5>
                    <a href="userMessages.php" class="btn btn-warning btn-sm mt-2">Open Inbox</a>
                </div>
            </div>
        </div>

        <!-- ✅ Transaction History -->
        <div class="col-md-4">
            <div class="card shadow text-center border-0">
                <div class="card-body">
                    <h5 class="fw-bold">My Transactions</h5>
                    <a href="purchaseHistory.php" class="btn btn-primary btn-sm mt-2">View History</a>
                </div>
            </div>
        </div>

    </div>

    <!-- ✅ User Info Section -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white fw-bold">
                    📢 My Dashboard Updates
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>✅ View & update your personal profile</li>
                        <li>✅ Check your membership plan validity</li>
                        <li>✅ Track your bills and receipts</li>
                        <li>✅ Send messages to Admin</li>
                        <li>✅ Access society updates & notices</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ✅ Date & Time -->
        <div class="col-md-4">
            <div class="card shadow border-0 text-center">
                <div class="card-header bg-primary text-white fw-bold">
                    📅 Today
                </div>
                <div class="card-body">
                    <h4 class="fw-bold"><?= date("d M Y") ?></h4>
                    <h5 id="userClock" class="text-muted"></h5>
                </div>
            </div>
        </div>
    </div>

</div>



    </div>
</div>
</main>
<!-- ✅ Live Clock -->
<script>
function updateUserClock(){
    let now = new Date();
    let time = now.toLocaleTimeString();
    document.getElementById("userClock").innerText = time;
}
setInterval(updateUserClock,1000);
updateUserClock();
</script>



<?php
include("footer.php");
}else{
    include("index.php");
}
?>
