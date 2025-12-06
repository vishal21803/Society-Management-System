
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
        <span><i class="bi bi-map me-2"></i> Manage Zones</span>
        
    <button class="btn btn-success btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#addZoneModal">
        + Add Zone
    </button>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle text-center" id="myTable">
            
            <!-- ✅ TABLE HEADER -->
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Zone Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <!-- ✅ TABLE BODY -->
            <tbody>
                <?php
                $resZ = mysqli_query($con,"SELECT * FROM zones where zstatus=0 or zstatus=1 ORDER BY zone_name ASC");
                $i=1;
                while($z = mysqli_fetch_assoc($resZ)){
                ?>
                <tr id="zoneRow<?= $z['zone_id'] ?>">
                    <td><?= $i++ ?></td>
                    <td><?= $z['zone_name'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-success"
                            onclick="editZone(<?= $z['zone_id'] ?>,'<?= $z['zone_name'] ?>')">
                            Edit
                        </button>

                        <button class="btn btn-sm btn-danger"
                            onclick="deleteZone(<?= $z['zone_id'] ?>)">
                            Delete
                        </button>

<?php if($z['zstatus'] == 1){ ?>

    <!-- ✅ ACTIVE → SHOW DEACTIVATE -->
    <button class="btn btn-sm btn-danger"
        onclick="deactivateZone(<?= $z['zone_id'] ?>)">
        Deactivate
    </button>

<?php } else { ?>

    <!-- ✅ INACTIVE → SHOW ACTIVATE -->
    <button class="btn btn-sm btn-success"
        onclick="activateZone(<?= $z['zone_id'] ?>)">
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

     <!-- ZONE UPDATE MODAL -->
<div class="modal fade" id="zoneModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5>Edit Zone</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editZoneId">
        <input type="text" id="editZoneName" class="form-control">
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateZone()">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ ADD ZONE MODAL -->
<div class="modal fade" id="addZoneModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5 class="modal-title">➕ Add New Zone</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        
        <form id="zoneFormAjax">
                               
                                <div class="mb-3">
                                    <label class="form-label">Zone Name</label>
                                    <input type="text" name="zone_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Save Zone</button>
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
