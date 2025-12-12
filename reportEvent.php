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
                <span><i class="bi bi-receipt-cutoff me-2"></i> Receipt Report</span>

                <!-- Agar future me add bill button chahiye ho -->
                <!-- <a href="billForm.php">
                    <button class="btn btn-success btn-sm">
                        + Add Bill
                    </button>
                </a> -->
            </div>


<div class="card-body">
    <div class="table-responsive mobile-table">
      <div class="row mb-3">

    <!-- DATE RANGE -->
    <div class="col-md-3">
        <label>Start Date</label>
        <input type="date" id="startDate" class="form-control">
    </div>

    <div class="col-md-3">
        <label>End Date</label>
        <input type="date" id="endDate" class="form-control">
    </div>


      <div class="col-md-3">
        <label>Show Type</label>
        <select id="filterShow" class="form-control">
            <?php
            $type = mysqli_query($con, "SELECT distinct toshow_type FROM sens_events");
            while ($z = mysqli_fetch_assoc($type)) {
                echo "<option>{$z['toshow_type']}</option>";
            }
            ?>
        </select>
    </div>




</div>

               <table class="table table-bordered table-hover align-middle text-center w-100" id="myEventTable">

<thead class="table-dark">
    <tr>
        <th>#</th>
                <th>Created At</th>

        <th>Title</th>
        <th>Visibility To</th>
      
        <th>To Show Type</th>
       
    </tr>
</thead>
<tbody>
<?php
$i = 1;
$query = "SELECT * FROM sens_events ORDER BY event_id DESC";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_assoc($result)) {

    // Default:
    $displayName = "-";

    // ✔ If visibility is for Zone
    if ($row['toshow_type'] == "zone") {
        $z = mysqli_query($con, "SELECT zone_name FROM sens_zones WHERE zone_id = '".$row['toshow_id']."'");
        $zname = mysqli_fetch_assoc($z);
        $displayName = $zname['zone_name'] ?? "-";
    }

    // ✔ If visibility is for City
    else if ($row['toshow_type'] == "city") {
        $c = mysqli_query($con, "SELECT city_name FROM sens_cities WHERE city_id = '".$row['toshow_id']."'");
        $cname = mysqli_fetch_assoc($c);
        $displayName = $cname['city_name'] ?? "-";
    }

    // ✔ If visibility is for Member
    else if ($row['toshow_type'] == "member") {
        $m = mysqli_query($con, "SELECT fullname FROM sens_members WHERE member_id = '".$row['toshow_id']."'");
        $mname = mysqli_fetch_assoc($m);
        $displayName = $mname['fullname'] ?? "-";
    }

    // ✔ If visible to all
    else if ($row['toshow_type'] == "all") {
        $displayName = "All Members";
    }

    // ✔ Other types
    else {
        $displayName = "-";
    }
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>

    <td><?= htmlspecialchars($row['title']) ?></td>

    <td><?= htmlspecialchars($row['toshow_type']) ?></td>

    <!-- 👇 Here we show related names -->
    <td><?= htmlspecialchars($displayName) ?></td>

</tr>
<?php } ?>
</tbody>

</table>

               </div>
            </div>
        </div>

    </div>
</div>



</main>


<?php include("footer.php"); } else { include("index.php"); } ?>
