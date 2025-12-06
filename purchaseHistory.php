<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

// Member ID from session
$member_id = $_SESSION['member_id'];
$today = date('Y-m-d');

/* ============================
   1️⃣ Get member details + plan
============================ */
$mem = mysqli_fetch_assoc(mysqli_query($con,"
    SELECT m.*, p.name AS plan_name, p.price AS plan_price
    FROM members m 
    JOIN plans p ON m.plan_id = p.plan_id 
    WHERE m.member_id='$member_id'
"));

$membershipStart = $mem['membership_start'];
$membershipEnd   = $mem['membership_end'];
$planPrice       = $mem['plan_price'];

/* ============================
   2️⃣ Get wallet balance
============================ */
$walletRow = mysqli_fetch_assoc(mysqli_query($con,"SELECT amount FROM wallet WHERE member_id='$member_id'"));
$walletAmount = $walletRow['amount'] ?? 0;

/* ============================
   3️⃣ Initialize pending years array
============================ */
$pendingYears = [];

/* ============================
   4️⃣ Membership end logic + wallet check
============================ */
if(!empty($membershipEnd) && $today > $membershipEnd){
    $checkDate = $membershipEnd;

    while($today > $checkDate){
        $yearExpired = date('Y', strtotime($checkDate)) + 1;

        if($walletAmount >= $planPrice){
            // Wallet sufficient → extend membership
            $newStart = date('Y-m-d', strtotime($checkDate . ' +1 day'));
            $newEnd   = date('Y-m-d', strtotime($newStart . ' +1 year'));

            mysqli_query($con, "
                UPDATE members
                SET membership_start='$newStart', membership_end='$newEnd'
                WHERE member_id='$member_id'
            ");

            $walletAmount -= $planPrice;
            mysqli_query($con, "UPDATE wallet SET amount='$walletAmount' WHERE member_id='$member_id'");

            $checkDate = $newEnd; // next iteration
        } else {
            // Wallet insufficient → pending year
            $pendingYears[] = $yearExpired;
            $checkDate = date('Y-m-d', strtotime($checkDate . ' +1 year'));
        }
    }
}

/* ============================
   5️⃣ Include past unpaid payments
============================ */
$payRes = mysqli_query($con,"SELECT payment_for_year, status FROM payments WHERE member_id='$member_id'");
while($pay = mysqli_fetch_assoc($payRes)) {
    if($pay['status'] == 'due' && !in_array($pay['payment_for_year'], $pendingYears)){
        if($pay['payment_for_year'] <= date('Y', strtotime($today))){
            $pendingYears[] = $pay['payment_for_year'];
        }
    }
}

$pendingYears = array_unique($pendingYears);
sort($pendingYears);
$totalPending = count($pendingYears) * $planPrice;

?>

<main>
<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container">
            <h3>Membership  Summary</h3>
            
            <div class="row">
                <!-- Membership Info -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm p-3">
                        <h5>Membership Details</h5>
                        <p><strong>Plan:</strong> <?= $mem['plan_name'] ?></p>
                        <p><strong>Price per Year:</strong> ₹<?= $planPrice ?></p>
                        <p><strong>Membership Start:</strong> <?= date('d M Y', strtotime($membershipStart)) ?></p>
                        <p><strong>Membership End:</strong> <?= date('d M Y', strtotime($membershipEnd)) ?></p>
                        <p><strong>Your Amount:</strong> ₹<?= $walletAmount ?></p>
                    </div>
                </div>

                <!-- Pending Info -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm p-3">
                        <h5>Pending Details</h5>
                        <?php if(!empty($pendingYears)): ?>
                            <p><strong>Pending Year(s):</strong> <?= implode(', ', $pendingYears) ?></p>
                            <p><strong>Total Pending Amount:</strong> ₹<?= $totalPending ?></p>
                        <?php else: ?>
                            <p class="text-success">✅ No pending years. Membership is up to date.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <div class="card shadow-sm p-3">
                <h5>Payment History</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th>Year</th> -->
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                            <th>Receipt No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $payHistory = mysqli_query($con,"SELECT * FROM payments WHERE member_id='$member_id' ORDER BY payment_for_year DESC");
                        while($row = mysqli_fetch_assoc($payHistory)){
                            echo "<tr>
                                
                                <td>₹{$row['amount']}</td>
                                <td>".date('d M Y', strtotime($row['payment_date']))."</td>
                                <td>{$row['receipt_no']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
