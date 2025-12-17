<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">


        <!-- ✅ SAME CARD DESIGN AS EVENTS -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-receipt-cutoff me-2"></i> Manage Bills</span>

                <!-- Agar future me add bill button chahiye ho -->
                <!-- <a href="billForm.php">
                    <button class="btn btn-success btn-sm">
                        + Add Bill
                    </button>
                </a> -->
            </div>


<div class="card-body">
    <div class="table-responsive mobile-table">
                <!-- ✅ SAME TABLE STYLE -->
                <table class="table table-bordered table-hover align-middle text-center w-100" id="myTable">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Zone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i=1;
                        $query = "
                        SELECT m.member_id, m.fullname, u.email, c.city_name, z.zone_name
                        FROM sens_members m
                        JOIN sens_users u ON m.user_id = u.id
                        JOIN sens_cities c ON m.city_id = c.city_id
                        JOIN sens_zones z ON m.zone_id = z.zone_id
                        ORDER BY m.member_id DESC
                        ";
                        $result = mysqli_query($con, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>

                            <td><?= htmlspecialchars($row['fullname']) ?></td>

                            <td><?= htmlspecialchars($row['city_name']) ?></td>

                            <td><?= htmlspecialchars($row['zone_name']) ?></td>


                            <td>
                               

                                <button title="Add Bill" class="btn btn-sm btn-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#billModal<?= $row['member_id'] ?>">
                                    <i class="bi bi-plus"></i>

                                </button>
                                 <button title="Edit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#historyModal<?= $row['member_id'] ?>">
                                    <i class="bi bi-pencil"></i>

                                </button>

                              
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
               </div>
            </div>
        </div>

    </div>
</div>


<?php
// ✅ RE-RUN QUERY ONLY FOR MODALS
$result2 = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result2)) {
$member_id = $row['member_id'];
?>

<!-- ✅ HISTORY MODAL -->
<div class="modal fade" id="historyModal<?= $member_id ?>" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Payment History - <?= htmlspecialchars($row['fullname']) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered table-striped text-center">
          <thead class="table-dark">
            <tr>
              <th>Date</th>
              <th>Bill Amount</th>
              <th>Purpose</th>
              <th>Bill Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

<?php
$historyQuery = "

 SELECT 
  bill_id,bill_type,bdate,
   bill_date AS trans_date,
   bill_amount AS bill_amt,
   '' AS receipt_amt,
   bill_purpose AS purpose,
   'Bill' AS type,
   '' AS manual_id,
   '' AS rid
 FROM sens_bills
 WHERE member_id='$member_id'


ORDER BY bdate DESC
";


$totalBill = 0;
$totalReceipt = 0;

$historyResult = mysqli_query($con, $historyQuery);

if(mysqli_num_rows($historyResult)>0){
while($h = mysqli_fetch_assoc($historyResult)){

    // ✅ Totals calculation
    if($h['bill_amt']!=''){
        $totalBill += $h['bill_amt'];
    }

  
?>
<tr>
  <td><?= date("d-m-Y", strtotime($h['bdate'])) ?></td>

  <td><?= $h['bill_amt']!='' ? '₹'.$h['bill_amt'] : '-' ?></td>


  <td><?= htmlspecialchars($h['purpose']) ?></td>

    <td><?= htmlspecialchars($h['bill_type']) ?></td>


  <td>
  <!-- EDIT -->
  <button class="btn btn-sm btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#editBillModal<?= $h['bill_id'] ?>">
    <i class="bi bi-pencil"></i>
  </button>

  <!-- DELETE -->
  <a href="deleteBill.php?bill_id=<?= $h['bill_id'] ?>&member_id=<?= $member_id ?>"
     onclick="return confirm('Are you sure to delete this bill?')"
     class="btn btn-sm btn-danger">
    <i class="bi bi-trash"></i>
  </a>
</td>


 

 


    
</tr>
<?php 
}} else { ?>
<tr>
  <td colspan="7" class="text-danger">No History Found</td>
</tr>
<?php } ?>

<!-- ✅ ✅ ✅ TOTAL ROW -->
<!-- <tr class="table-dark fw-bold">
  <td>Total</td>
  <td>₹<?= $totalBill ?></td>
  <td>₹<?= $totalReceipt ?></td>
  <td colspan="3">Balance ₹<?= ($totalBill - $totalReceipt) ?></td>
  <td></td>
</tr> -->

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
mysqli_data_seek($historyResult, 0);
while($h = mysqli_fetch_assoc($historyResult)) {
?>
<div class="modal fade" id="editBillModal<?= $h['bill_id'] ?>" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="updateBill.php">
      <div class="modal-content">

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Edit Bill</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="bill_id" value="<?= $h['bill_id'] ?>">
          <input type="hidden" name="member_id" value="<?= $member_id ?>">
          <input type="hidden" name="old_amount" value="<?= $h['bill_amt'] ?>">

          <label>Bill Amount</label>
          <input type="number" name="new_amount"
                 value="<?= $h['bill_amt'] ?>"
                 class="form-control mb-2" required>

          <label>Purpose</label>
          <input type="text" name="purpose"
                 value="<?= htmlspecialchars($h['purpose']) ?>"
                 class="form-control" required>

                   <label for="">Bill Type</label>
  <select name="type" class="form-control" required>
    <option value="<?= htmlspecialchars($h['bill_type']) ?>"><?= htmlspecialchars($h['bill_type']) ?></option>
    <option value="New Membership">New Membership</option>
    <option value="Yearly Fee">Yearly Fee</option>
    <option value="Lifetime Fee">Lifetime Fee</option>
    <option value="Scholarship">Scholarship</option>
    <option value="Donation">Donation</option>
            <option value="Others">Others</option>

  </select>

   <label for="">Bill Date</label>
<input type="date" name="bildate"
                 value="<?= htmlspecialchars($h['bdate']) ?>"
                 class="form-control" required>
         
        
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
        </div>

      </div>
    </form>
  </div>
</div>
<?php } ?>



<!-- ✅ BILL MODAL -->
<div class="modal fade" id="billModal<?= $member_id ?>" tabindex="-1">
  <div class="modal-dialog">
    <form action="save_bill.php" method="POST">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Generate Bill</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="member_id" value="<?= $member_id ?>">
          <!-- <label for="">Bill Date</label>
          <input type="date" name="bill_date" class="form-control mb-2" required> -->
          <label for="">Bill Amount</label>
          <input type="number" name="bill_amount" class="form-control mb-2" required>
          <label for="">Bill Description</label>
          <input type="text" name="purpose" class="form-control" required>

           <label for="">Bill Type</label>
  <select name="type" class="form-control" required>
    <option value="">-- Select Purpose --</option>
    <option value="New Membership">New Membership</option>
    <option value="Yearly Fee">Yearly Fee</option>
    <option value="Lifetime Fee">Lifetime Fee</option>
    <option value="Scholarship">Scholarship</option>
    <option value="Donation">Donation</option>
            <option value="Others">Others</option>

  </select>

   <label for="">Bill Date</label>
<input type="date" name="bill_date" class="form-control mb-2"
       value="<?php echo date('Y-m-d'); ?>" required>        <!-- #region -->


        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Bill</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php } ?>
</main>

<?php include("footer.php"); } else { include("index.php"); } ?>
