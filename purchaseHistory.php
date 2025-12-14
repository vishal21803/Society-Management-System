<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

// Member ID from session
$member_id = $_SESSION['member_id'];

// Fetch member + plan info
$planQuery = mysqli_query($con,"
    SELECT m.membership_start, m.membership_end, p.name AS plan_name, p.price, p.duration_days
    FROM sens_members m
    JOIN sens_plans p ON m.plan_id = p.plan_id
    WHERE m.member_id='$member_id'
");
$plan = mysqli_fetch_assoc($planQuery);
?>

<main>
<div class="d-flex flex-column flex-lg-row">
    <?php include('userDashboard.php'); ?>

    <div class="flex-grow-1 p-3 p-lg-4 w-100 overflow-hidden" >

        <!-- ✅ Membership / Plan Info Card -->
        <div class="membership-card mb-4 p-4 bg-white shadow rounded d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-2">Plan: <?= htmlspecialchars($plan['plan_name']) ?></h5>
                <p class="mb-1"><strong>Price:</strong> ₹<?= $plan['price'] ?></p>
                <!-- <p class="mb-1"><strong>Duration:</strong> <?= $plan['duration_days'] ?> Days</p> -->
                <!-- <p class="mb-0"><strong>Start:</strong> <?= date("d M Y", strtotime($plan['membership_start'])) ?></p>
                <p class="mb-0"><strong>End:</strong> <?= date("d M Y", strtotime($plan['membership_end'])) ?></p> -->
                <?php
$startDate = (!empty($plan['membership_start'])) 
    ? date("d M Y", strtotime($plan['membership_start'])) 
    : "Not Started";


?>

<p class="mb-0"><strong>Start:</strong> <?= $startDate ?></p>

            </div>
            <div>

        <?php
$statusText  = "Not Active";
$statusColor = "danger";

/* ✅ Sirf membership_start check hoga */
if(
    !empty($plan['membership_start']) &&
    $plan['membership_start'] != '0000-00-00'
){
    $statusText  = "Active";
    $statusColor = "success";
}
?>
<span class="badge bg-<?= $statusColor ?> p-2 fs-6">
    <?= $statusText ?>
</span>

            </div>
        </div>
     


        <!-- ✅ History Table Section -->
        <div class="history-table-container bg-white shadow rounded p-3">

            <h4 class="mb-3 fw-bold">📜 Transaction History</h4>

            <div class="table-responsive mobile-table" >
                <table class="table table-bordered table-striped text-center mb-0">
                  <thead class="table-dark position-sticky top-0">
                    <tr>
                      <th>Date</th>
                      <th>Bill Amount</th>
                      <th>Receipt Amount</th>
                      <th>Purpose</th>
                      <th>Bill type</th>
                      <th>Downoad</th>
                      <th>Receipt ID</th>
                    </tr>
                  </thead>
                  <tbody>

<?php
$historyQuery = "
(
 SELECT 
   bill_id AS ref_id,
   bill_date AS trans_date,
   bill_amount AS bill_amt,
   bill_type AS btype,
   NULL AS receipt_amt,
   bill_purpose AS purpose,
   'Bill' AS type,
   NULL AS manual_id
 FROM sens_bills
 WHERE member_id='$member_id'
)
UNION ALL
(
 SELECT 
   receipt_id AS ref_id,
   receipt_date AS trans_date,
   NULL AS bill_amt,
   NULL AS btype,
   receipt_amount AS receipt_amt,
   purpose,
   'Receipt' AS type,
   manualID AS manual_id
 FROM sens_receipt
 WHERE member_id='$member_id'
)
ORDER BY trans_date DESC
";



$totalBill = 0;
$totalReceipt = 0;

$historyResult = mysqli_query($con, $historyQuery);

if(mysqli_num_rows($historyResult)>0){
while($h = mysqli_fetch_assoc($historyResult)){

    if($h['bill_amt']!=''){
        $totalBill += $h['bill_amt'];
    }

    if($h['receipt_amt']!=''){
        $totalReceipt += $h['receipt_amt'];
    }
?>
<tr>
  <td><?= date("d-m-Y", strtotime($h['trans_date'])) ?></td>
  <td><?= $h['bill_amt']!='' ? '₹'.$h['bill_amt'] : '-' ?></td>
  <td><?= $h['receipt_amt']!='' ? '₹'.$h['receipt_amt'] : '-' ?></td>
  <td><?= htmlspecialchars($h['purpose']) ?></td>
    <td><?= $h['btype']!='' ? '₹'.$h['btype'] : '-' ?></td>


 <td>
<?php if($h['type']=='Bill'){ ?>
    <a href="">
        <span class="badge bg-success">Bill</span>
    </a>
<?php } else { ?>
    <a href="tempReceipt.php?receipt_id=<?= $h['ref_id'] ?>">
        <span class="badge bg-warning">Receipt</span>
    </a>
<?php } ?>
</td>

  <td><?= $h['manual_id']!='' ? htmlspecialchars($h['manual_id']) : '-' ?></td>
  
</tr>
<?php 
}} else { ?>
<tr>
  <td colspan="6" class="text-danger">No History Found</td>
</tr>
<?php } ?>

<tr class="table-dark fw-bold">
  <td>Total</td>
  <td>₹<?= $totalBill ?></td>
  <td>₹<?= $totalReceipt ?></td>
  <td colspan="3">Balance ₹<?= ($totalBill - $totalReceipt) ?></td>
  <td></td>
</tr>

                  </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</main>

<style>
    
/* Membership card hover effect */
.membership-card {
    transition: transform 0.3s;
}
.membership-card:hover {
    transform: translateY(-5px) scale(1.02);
}

/* Scrollable table container */
/* Scrollable table container */
.history-table-container .table-responsive {
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 0.5rem;
    max-height: 350px; /* height kam kar di */
    overflow-y: auto;
        overflow-x: auto;

}



/* Sticky table header */
.table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: #343a40;
    color: #fff;
}
/* ✅ Mobile overflow fix */
@media (max-width: 768px){

    /* Prevent horizontal overflow */
    body, main {
        overflow-x: hidden;
    }

    /* Table font & spacing */
    .mobile-table table{
        font-size: 13px;
    }

    .mobile-table th,
    .mobile-table td{
        padding: 6px;
        white-space: nowrap;
    }

    /* Hide less important columns on phone */
    .mobile-table th:nth-child(5),
    .mobile-table td:nth-child(5), /* Bill type */

    .mobile-table th:nth-child(7),
    .mobile-table td:nth-child(7)  /* Receipt ID */
    {
        display: none;
    }

    /* Membership card stacking */
    .membership-card{
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

</style>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
