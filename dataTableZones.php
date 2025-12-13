
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>


<?php if(isset($_GET['add']) && $_GET['add'] == 1) { ?>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var myModal = new bootstrap.Modal(document.getElementById("addedModal"));
        myModal.show();
    });
</script>
<?php } ?>

<main>
<div class="d-flex flex-column flex-lg-row">
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
  
<div id="editMessage"></div>

    <div class="card-body">
    <div class="table-responsive mobile-table">
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
$resZ = mysqli_query($con,
    "SELECT * FROM sens_zones 
     
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);                $i=1;
                while($z = mysqli_fetch_assoc($resZ)){
                ?>
                <tr id="zoneRow<?= $z['zone_id'] ?>">
                    <td><?= $i++ ?></td>
                    <td><?= $z['zone_name'] ?></td>
                    <td>
                        <button title="Edit" class="btn btn-sm btn-primary"
                            onclick="editZone(<?= $z['zone_id'] ?>,'<?= $z['zone_name'] ?>')">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <button title="Delete" class="btn btn-sm btn-danger"
                            onclick="deleteZone(<?= $z['zone_id'] ?>)">
                        <i class="bi bi-trash"></i>

                        </button>

<?php if($z['zstatus'] == 1){ ?>

    <!-- ✅ ACTIVE → SHOW DEACTIVATE -->
    <button title="Deactivate" class="btn btn-sm btn-danger"
        onclick="deactivateZone(<?= $z['zone_id'] ?>)">
        <i class="bi bi-x"></i>
    </button>

<?php } else { ?>

    <!-- ✅ INACTIVE → SHOW ACTIVATE -->
    <button title="Activate" class="btn btn-sm btn-success"
        onclick="activateZone(<?= $z['zone_id'] ?>)">
        <i class="bi bi-check"></i>
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
        
        <form id="addZoneForm">
    <div class="mb-3">
        <label class="form-label">Zone Name</label>
        <input type="text" name="zone_name" id="zone_name" class="form-control" required>
    </div>

    <button type="button" class="btn btn-warning" onclick="saveZone()">Save Zone</button>

    <div id="zoneMessage" class="mt-2"></div>
</form>

      </div>

    </div>
  </div>
</div>

<!-- SUCCESS MODAL -->
<div class="modal fade" id="addedModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Success</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Zone added successfully!
      </div>

      <div class="modal-footer">
        <button class="btn btn-success" data-bs-dismiss="modal">OK</button>
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

function saveZone(){
    let zoneName = $("#zone_name").val().trim();

    if(zoneName === ""){
        $("#zoneMessage").html('<span class="text-danger">Please enter zone name.</span>');

        setTimeout(() => { $("#zoneMessage").html(""); }, 3000);
        return;
    }

    $.post("zones_save.php", { zone_name: zoneName }, function(res){

        if(res.trim() === "success"){
            $("#zoneMessage").html('<span class="text-success fw-bold">✔ Zone added successfully!</span>');
            $("#zone_name").val("");  
        }
        else if(res.trim() === "exists"){
            $("#zoneMessage").html('<span class="text-warning fw-bold">⚠ Zone already exists!</span>');
        }
        else{
            $("#zoneMessage").html('<span class="text-danger">Error saving zone.</span>');
        }

        // 🕒 Auto fade message after 3 seconds
        setTimeout(() => { 
            $("#zoneMessage").fadeOut(400, function(){
                $(this).html("").show(); 
            });
        }, 3000);

    });
}

document.getElementById('addZoneModal').addEventListener('hidden.bs.modal', function () {
    location.reload();
});


</script>


<?php
include("footer.php");
}else{
    include("index.php");
}
?>
