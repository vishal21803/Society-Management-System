
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
    <div class="card shadow-lg border-0">
    <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
        <span><i class="bi bi-buildings me-2"></i> Manage Cities</span>
        
    <button class="btn btn-success btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#addZoneModal">
        + Add City
    </button>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle text-center" id="myTable">
            
            <!-- ✅ TABLE HEADER -->
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>City Name</th>
                    <th>Zone Name</th>
                    
                    <th>Action</th>
                </tr>
            </thead>

            <!-- ✅ TABLE BODY -->
            <tbody>
                <?php
  $resC = mysqli_query($con,"
                        SELECT c.city_id, c.city_name, z.zone_name ,c.cstatus
                        FROM cities c 
                        JOIN zones z ON c.zone_id = z.zone_id
                        ORDER BY c.city_name ASC
                    ");                $i=1;
                while($c = mysqli_fetch_assoc($resC)){
                ?>
                <tr id="cityRow<?= $c['city_id'] ?>">
                    <td><?= $i++ ?></td>
                    <td><?= $c['city_name'] ?></td>
                    <td><?= $c['zone_name'] ?></td>

                    <td>
                        <button class="btn btn-sm btn-success"
                            onclick="editCity(<?= $c['city_id'] ?>,'<?= $c['city_name'] ?>')">
                            Edit
                        </button>

                        <button class="btn btn-sm btn-danger"
                            onclick="deleteCity(<?= $c['city_id'] ?>)">
                            Delete
                        </button>

<?php if($c['cstatus'] == 1){ ?>

    <!-- ✅ ACTIVE → SHOW DEACTIVATE -->
    <button class="btn btn-sm btn-danger"
        onclick="deactivateCity(<?= $c['city_id'] ?>)">
        Deactivate
    </button>

<?php } else { ?>

    <!-- ✅ INACTIVE → SHOW ACTIVATE -->
    <button class="btn btn-sm btn-success"
        onclick="activateCity(<?= $c['city_id'] ?>)">
        Activate
    </button>

<?php } ?>


                    </td>
                </tr>
                <?php } ?>
            </tbody>

            <!-- ✅ TABLE FOOTER -->
            <tfoot class="table-secondary fw-bold">
                <tr>
                    <td colspan="2" class="text-end">Total Zones</td>
                    <td><?= $i-1 ?></td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>

    </div>
</div>

 <!-- CITY UPDATE MODAL -->
<div class="modal fade" id="cityModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5>Edit City</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editCityId">
        <input type="text" id="editCityName" class="form-control">
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateCity()">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ ADD ZONE MODAL -->
<div class="modal fade" id="addZoneModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5 class="modal-title">➕ Add New City</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        
         <form id="cityFormAjax">
                                <!-- <div class="mb-3">
                                    <label class="form-label">Select State</label>
                                    <select id="stateDropdown" class="form-select" onchange="loadZones();" required>
                                        <option value="">Select State</option>
                                        <?php
                                            $res2 = mysqli_query($con,"SELECT * FROM states ORDER BY state_name ASC");
                                            while($row2 = mysqli_fetch_array($res2)){
                                                echo "<option value='{$row2['state_id']}'>{$row2['state_name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div> -->
                                <div class="mb-3">
                                    <label class="form-label">Select Zone</label>
                                    <select id="zoneDropdown" name="zone_id" class="form-select" required>
                                        <option value="">Select Zone</option>
                                         <?php
                                            $res2 = mysqli_query($con,"SELECT * FROM zones ORDER BY zone_name ASC");
                                            while($row2 = mysqli_fetch_array($res2)){
                                                echo "<option value='{$row2['zone_id']}'>{$row2['zone_name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">City Name</label>
                                    <input type="text" name="city_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Save City</button>
                            </form>
      </div>

    </div>
  </div>
</div>

</main>

<script>
function showForm(id){
    var tabEl = new bootstrap.Tab(document.querySelector('#' + id + '-tab'));
    tabEl.show();
}
</script>


<?php
include("footer.php");
}else{
    include("index.php");
}
?>
