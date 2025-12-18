<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

?>

<main>
<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <?php
$member_id = $_SESSION["member_id"];

$q = mysqli_query($con,"
    SELECT * 
    FROM sens_required
    WHERE member_id='$member_id'
    ORDER BY require_id DESC
");

$i = 1;
?>

<div class="card shadow border-0">

    <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
        <span><i class="bi bi-gear-fill me-2"></i> Manage Requirements</span>

        <a href="addRequirement.php">
            <button class="btn btn-success btn-sm">+ Add Requirement</button>
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive mobile-table">

            <table id="myTable" class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Requirement Type</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($q)){ ?>
                    <tr id="srvRow<?= $row['require_id'] ?>">
                        <td><?= $i++ ?></td>
                        <td><?= $row['require_type'] ?></td>
                        <td><?= $row['require_desc'] ?></td>

                        <td>
                            <button title="Edit" class="btn btn-sm btn-primary"
                                onclick="openRequirementEditModal(
                                    <?= $row['require_id'] ?>,
                                    '<?= $row['require_type'] ?>',
                                    `<?= $row['require_desc'] ?>`
                                )">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button title="Delete" class="btn btn-sm btn-danger"
                                onclick="deleteRequirement(<?= $row['require_id'] ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>

            <div class="modal fade" id="requireEditModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5>Edit Requirement</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

    <input type="hidden" id="require_id">

    <div class="mb-2">
        <label>Requirement Type / Category</label>

        <select id="require_type" class="form-select" onchange="checkEditCategory()">
            <option value="">Select</option>
            <option value="Kirana">Kirana</option>
            <option value="Restaurant">Restaurant</option>
            <option value="Hotel">Hotel</option>
            <option value="Sanitary">Sanitary</option>
            <option value="Education">Education</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- textbox hidden -->
    <div class="mb-2 d-none" id="editOtherBox">
        <label>Enter Custom Category</label>
        <input type="text" id="edit_other_category" class="form-control">
    </div>

    <div class="mb-2">
        <label>Service Description</label>
        <textarea id="require_desc" class="form-control" rows="3"></textarea>
    </div>

</div>


      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateRequirement()">Update</button>
      </div>

    </div>
  </div>
</div>


        </div>
    </div>

</div>

    </div>
</div>
</main>

<script>
  function openRequirementEditModal(id, type, desc){

    $("#require_id").val(id);
    $("#require_desc").val(desc);

    // if category exists in list
    const select = document.getElementById("require_type");
    const otherBox = document.getElementById("editOtherBox");
    const otherInput = document.getElementById("edit_other_category");

    const options = [...select.options].map(o=>o.value);

    if(options.includes(type)){
        select.value = type;
        otherBox.classList.add("d-none");
        otherInput.value = "";
    }
    else{
        select.value = "Other";
        otherBox.classList.remove("d-none");
        otherInput.value = type;
    }

    $("#requireEditModal").modal("show");
}


function updateRequirement(){

    let cat = $("#require_type").val();

    // if dropdown selected Other → take textbox value
    if(cat === "Other"){
        cat = $("#edit_other_category").val().trim();
    }

    if(cat === ""){
        alert("Please enter require type");
        return;
    }

    $.post("updateRequire.php",{
        require_id: $("#require_id").val(),
        require_type: cat,
        require_desc: $("#require_desc").val()
    },function(res){

        if(res.trim()=="success"){
            alert("Updated Successfully");
            location.reload();
        } else {
            alert("Update Failed");
        }

    });
}


function deleteRequirement(id){
    if(confirm("Delete this service?")){
        $.post("deleteRequire.php",{id:id},function(res){

            if(res.trim()=="success"){
                $("#srvRow"+id).fadeOut();
            } else{
                alert("Delete Failed");
            }

        });
    }
}

function checkEditCategory(){

    let cat = document.getElementById("require_type").value;
    let box = document.getElementById("editOtherBox");

    if(cat === "Other"){
        box.classList.remove("d-none");
        document.getElementById("edit_other_category").required = true;
    } else {
        box.classList.add("d-none");
        document.getElementById("edit_other_category").required = false;
    }
}

</script>


<?php
include("footer.php");
}else{
    include("index.php");
}
?>
