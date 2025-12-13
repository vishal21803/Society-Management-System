<?php 
@session_start();

include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">
    <div class="flex-grow-1 p-4">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
         
        </div>

        <div class="card-body">
            <div class="table-responsive mobile-table">
                <div class="row mb-3">
    <div class="col-md-3">
        <label>Zone</label>
        <select id="filterzone" class="form-control">
            <option value="">All Zones</option>
            <?php
            $zones = mysqli_query($con,"SELECT zone_name FROM sens_zones ORDER BY zone_name");
            while($z = mysqli_fetch_assoc($zones)){
                echo "<option>{$z['zone_name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-3">
        <label>City</label>
        <select id="filtercity" class="form-control">
            <option value="">All Cities</option>
            <?php
            $cities = mysqli_query($con,"SELECT city_name FROM sens_cities ORDER BY city_name");
            while($c = mysqli_fetch_assoc($cities)){
                echo "<option>{$c['city_name']}</option>";
            }
            ?>
        </select>
    </div>
</div>

                <table class="table table-bordered table-hover align-middle text-center" id="myMemberTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Zone</th>
                            <th>City</th>
                        </tr>
                    </thead>

                    <tbody>
<?php
$res = mysqli_query($con,"
SELECT 
    m.member_id,
    m.user_id,
    m.fullname,
    m.phone,
    m.gender,
    m.dob,
    m.address,
    m.membership_start,
    m.membership_end,
    m.zone_id,
    m.city_id,
    m.plan_id,
    z.zone_name,
    c.city_name,
    u.email,
    r.status AS request_status
FROM sens_members m
LEFT JOIN sens_users u ON m.user_id = u.id
LEFT JOIN sens_zones z ON m.zone_id = z.zone_id
LEFT JOIN sens_cities c ON m.city_id = c.city_id
LEFT JOIN sens_requests r ON r.member_id = m.member_id
ORDER BY m.fullname ASC
");

$i = 1;
while($row = mysqli_fetch_assoc($res)){
?>
<tr id="memberRow<?= $row['member_id'] ?>">
    <td><?= $row["member_id"] ?></td>
    
    <td><?= htmlspecialchars($row['fullname']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['zone_name']) ?></td>
    <td><?= htmlspecialchars($row['city_name']) ?></td>
   
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

<!-- JS -->
<script>

</script>

<?php
include("footer.php");

?>
