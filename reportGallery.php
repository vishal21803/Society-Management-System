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
                <span><i class="bi bi-newspaper me-2"></i> Gallery Report</span>

              
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
        <label>Zone</label>
        <select id="filter_zone" class="form-control">
            <option value="">All</option>
            <?php
            $z=mysqli_query($con,"SELECT zone_name FROM sens_zones");
            while($r=mysqli_fetch_assoc($z)) echo "<option>{$r['zone_name']}</option>";
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <label>City</label>
        <select id="filter_city" class="form-control">
            <option value="">All</option>
            <?php
            $c=mysqli_query($con,"SELECT city_name FROM sens_cities");
            while($r=mysqli_fetch_assoc($c)) echo "<option>{$r['city_name']}</option>";
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <label>Member</label>
        <select id="filter_member" class="form-control">
            <option value="">All</option>
            <?php
            $m=mysqli_query($con,"SELECT fullname FROM sens_members");
            while($r=mysqli_fetch_assoc($m)) echo "<option>{$r['fullname']}</option>";
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <label>Created By</label>
        <select id="filter_created_by" class="form-control">
            <option value="">All</option>
            <?php
            $u=mysqli_query($con,"SELECT DISTINCT created_by FROM sens_gallery");
            while($r=mysqli_fetch_assoc($u)) echo "<option>{$r['created_by']}</option>";
            ?>
        </select>
    </div>

</div>


                <!-- ✅ SAME TABLE DESIGN -->
                <table id="myGalleryTable" class="table table-bordered table-hover align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                             <th>News Date</th>
    <th>Show To</th>
    <th>Created By</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
$q = mysqli_query($con,"
SELECT 
    g.*,
    z.zone_name,
    c.city_name,
    m.fullname AS member_name,
    g.created_by AS created_by_name
FROM sens_gallery g
LEFT JOIN sens_zones z ON (g.visibility_type='zone' AND g.zone_id = z.zone_id)
LEFT JOIN sens_cities c ON (g.visibility_type='city' AND g.city_id = c.city_id)
LEFT JOIN sens_members m ON (g.visibility_type='member' AND g.member_id = m.member_id)
ORDER BY g.gallery_id DESC
");


                  $i=1;
while($row = mysqli_fetch_assoc($q)){

    if($row['visibility_type']=='all'){
        $showTo = "All Members";
    }elseif($row['visibility_type']=='zone'){
        $showTo = $row['zone_name'];
    }elseif($row['visibility_type']=='city'){
        $showTo = $row['city_name'];
    }elseif($row['visibility_type']=='member'){
        $showTo = "Member: ".$row['member_name'];
    }else{
        $showTo = "-";
    }

?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= date("Y-m-d", strtotime($row['created_at'])) ?></td>
    <td><?= htmlspecialchars($showTo) ?></td>
    <td><?= htmlspecialchars($row['created_by_name']) ?></td>
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
