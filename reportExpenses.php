<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<!-- ✅ DATATABLE CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">


        <!-- ✅ SAME CARD LAYOUT AS EVENTS -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-newspaper me-2"></i> Expenses Report</span>

              
            </div>


<div class="card-body">
    <div class="table-responsive mobile-table">
 <div class="row mb-3">

   <div class="col-md-3">
    <label>Expense Type</label>
    <select id="filter_expense_type" class="form-control">
        <option value="">-- Select Expense Type --</option>
        <option value="Rent">Rent</option>
        <option value="Electricity">Electricity</option>
        <option value="Maintenance">Maintenance</option>
        <option value="Other">Other</option>
    </select>
    <input type="text" id="filter_expense_other" class="form-control mt-2" placeholder="Enter custom type" style="display:none;">
</div>


    <div class="col-md-3">
        <label>From Date</label>
        <input type="date" id="filter_from_date" class="form-control">
    </div>

    <div class="col-md-3">
        <label>To Date</label>
        <input type="date" id="filter_to_date" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Created By</label>
        <select id="filter_created_by" class="form-control">
            <option value="">All</option>
            <?php
            $u = mysqli_query($con,"SELECT DISTINCT created_by FROM sens_expenses");
            while($r=mysqli_fetch_assoc($u)){
                echo "<option>{$r['created_by']}</option>";
            }
            ?>
        </select>
    </div>

</div>





              <table id="expenseTable" class="table table-bordered table-hover align-middle">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Expense Type</th>   <!-- index 1 -->
    <th>Amount</th>
    <th>Date</th>           <!-- index 3 -->
    <th>Remark</th>
    <th>Created By</th>     <!-- index 5 -->
</tr>
</thead>

<tbody>
<?php
$i=1;
$q=mysqli_query($con,"SELECT * FROM sens_expenses ORDER BY expense_id DESC");
while($row=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($row['expense_type']) ?></td>
     <td><?= htmlspecialchars($row['expense_amount']) ?></td>
   
    <td><?= date("Y-m-d",strtotime($row['created_at'])) ?></td>
    <td><?= htmlspecialchars($row['expense_remark']) ?></td>

    <td><?= htmlspecialchars($row['created_by']) ?></td>
</tr>
<?php } ?>
</tbody>
</table>


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
