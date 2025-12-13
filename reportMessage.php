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
                <span><i class="bi bi-newspaper me-2"></i> Message Report</span>

              
            </div>


<div class="card-body">
    <div class="table-responsive mobile-table">
   <div class="row mb-3">

<div class="col-md-2">
    <label>From Date</label>
    <input type="date" id="filter_from_date" class="form-control">
</div>

<div class="col-md-2">
    <label>To Date</label>
    <input type="date" id="filter_to_date" class="form-control">
</div>

<div class="col-md-2">
    <label>Sender Type</label>
    <select id="filter_sender_type" class="form-control">
        <option value="">All</option>
        <option value="admin">admin</option>
        <option value="user">user</option>
    </select>
</div>

<div class="col-md-2">
    <label>Sender Name</label>
    <select id="filter_sender" class="form-control">
        <option value="">All</option>
        <?php
        $u=mysqli_query($con,"SELECT id,name FROM sens_users");
        while($r=mysqli_fetch_assoc($u))
            echo "<option>{$r['name']}</option>";
        ?>
    </select>
</div>


<div class="col-md-2">
    <label>Receiver Type</label>
    <select id="filter_receiver_type" class="form-control">
        <option value="">All</option>
        <option value="admin">admin</option>
        <option value="user">user</option>
    </select>
</div>

<div class="col-md-2">
    <label>Receiver Name</label>
    <select id="filter_receiver" class="form-control">
        <option value="">All</option>
        <?php
        $u=mysqli_query($con,"SELECT id,name FROM sens_users");
        while($r=mysqli_fetch_assoc($u))
            echo "<option>{$r['name']}</option>";
        ?>
    </select>
</div>

<!-- <div class="col-md-2">
    <label>Created By</label>
    <input type="text" id="filter_created_by" class="form-control">
</div> -->

</div>



                <!-- ✅ SAME TABLE DESIGN -->
                <table id="myMessageTable" class="table table-bordered table-hover align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                         <th>#</th>
    <th>Date</th>
    <th>Sender Type</th>
    <th>Sender</th>
    <th>Receiver Type</th>
    <th>Receiver</th>
    <th>Subject</th>
    <th>Created By</th>

                            
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
$q = mysqli_query($con,"
SELECT 
    m.*,
    us.name AS sender_name,
    ur.name AS receiver_name
FROM sens_messages m
LEFT JOIN sens_users us ON m.sender_id = us.id
LEFT JOIN sens_users ur ON m.receiver_id = ur.id
ORDER BY m.id DESC
");



                  $i=1;
while($row = mysqli_fetch_assoc($q)){

 
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= date("Y-m-d",strtotime($row['created_at'])) ?></td>
    <td><?= $row['sender_type']?></td>
    <td><?= htmlspecialchars($row['sender_name']) ?></td>
        <td><?= $row['receiver_type']?></td>

    <td><?= htmlspecialchars($row['receiver_name']) ?></td>
    <td><?= htmlspecialchars($row['subject']) ?></td>
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
