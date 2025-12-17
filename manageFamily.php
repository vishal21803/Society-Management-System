
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

    $member_id = $_SESSION['member_id']; // ✅ Fixed line

?>


<main>
<div class="d-flex flex-column flex-lg-row">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">

        <div class="card shadow border-0">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people-fill me-2"></i> Manage Family Members</span>

                <a href="addFamily.php">
                    <button class="btn btn-success btn-sm">+ Add Family Member</button>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive mobile-table">

                    <table id="myTable" class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Member</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Relation</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i=1;

                            $q = mysqli_query($con,"
                                SELECT f.*, m.fullname AS member_name 
                                FROM sens_family f
                                LEFT JOIN sens_members m ON f.member_id = m.member_id where f.member_id='$member_id'
                                ORDER BY f.fam_id DESC
                            ");

                            while($row = mysqli_fetch_assoc($q)){
                            ?>
                            <tr id="famRow<?= $row['fam_id'] ?>">
                                <td><?= $i++ ?></td>
                                <td><?= $row['fam_name'] ?></td>
                                <td><?= $row['fam_gender'] ?></td>
                                <td><?= $row['fam_phone'] ?></td>
                                <td><?= $row['fam_relation'] ?></td>

                                <td>
                                    <button title="Edit" class="btn btn-sm btn-primary"
                                       onclick="openFamEditModal(
    <?= $row['fam_id'] ?>,
    <?= $row['member_id'] ?>,
    '<?= $row['fam_name'] ?>',
    '<?= $row['fam_gender'] ?>',
    '<?= $row['fam_phone'] ?>',
    '<?= $row['fam_dob'] ?>',
    '<?= $row['fam_education'] ?>',
    '<?= $row['fam_relation'] ?>',
    '<?= $row['marry_status'] ?>'
)"
>
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button title="Delete" class="btn btn-sm btn-danger"
                                        onclick="deleteFamily(<?= $row['fam_id'] ?>)">
                                        <i class="bi bi-trash"></i>
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



<!-- EDIT MODAL -->
<div class="modal fade" id="famEditModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5>Edit Family Member</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" id="fam_id">
        <input type="hidden" id="fam_member_id">

        <div class="mb-2">
            <label>Family Member Name</label>
            <input type="text" id="fam_name" class="form-control">
        </div>

        <div class="mb-2">
            <label>Gender</label>
            <select id="fam_gender" class="form-select">
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Phone</label>
    <input type="number" 
       class="form-control" 
       placeholder="Phone Number" 
       id="fam_phone"
       required 
       oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">           </div>

        <!-- ✅ NEW: DOB -->
        <div class="mb-2">
            <label>Date of Birth</label>
            <input type="date" id="fam_dob" class="form-control">
        </div>

        <!-- ✅ NEW: Education -->
        <div class="mb-2">
            <label>Education</label>
            <input type="text" id="fam_education" class="form-control" placeholder="Eg. B.Com, B.Tech, 12th...">
        </div>

          <div class="mb-2">
                            <label class="fw-semibold">Marital Status</label>
                               <select id="fam_marry" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="Married">Married</option>
                                <option value="Unmarried">Unmarried</option>
                            </select>
                        </div>

        <div class="mb-2">
            <label>Relation</label>

    <select name="" id="fam_relation" class="form-select" onchange="checkRelation()" required>
        <option value="">Select Relation</option>
        <option value="Father">Father</option>
        <option value="Mother">Mother</option>
        <option value="Wife">Wife</option>
        <option value="Husband">Husband</option>
        <option value="Son">Son</option>
        <option value="Daughter">Daughter</option>
        <option value="Brother">Brother</option>
        <option value="Sister">Sister</option>
        <option value="Other">Other</option>
    </select>       
 </div>
 <div class="col-md-12 mb-3 d-none" id="otherRelationBox">
    <label class="fw-semibold">Enter Relation</label>
    <input type="text" name="other_relation" id="other_relation" class="form-control" placeholder="Write relation...">
</div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateFamily()">Update</button>
      </div>

    </div>
  </div>
</div>


</main>


<script>
    function openFamEditModal(id, member_id, name, gender, phone, dob, education, relation,marry){
    $("#fam_id").val(id);
    $("#fam_member_id").val(member_id);
    $("#fam_name").val(name);
    $("#fam_gender").val(gender);
    $("#fam_phone").val(phone);
    $("#fam_dob").val(dob);
    $("#fam_education").val(education);
    $("#fam_relation").val(relation);
    $("#fam_marry").val(marry);

    $("#famEditModal").modal("show");
}


function updateFamily(){
    let relation = $("#fam_relation").val();
    if(relation === "Other"){
        relation = $("#other_relation").val();
    }

    $.post("updateFamily.php",{
        fam_id: $("#fam_id").val(),
        member_id: $("#fam_member_id").val(),
        fam_name: $("#fam_name").val(),
        fam_gender: $("#fam_gender").val(),
        fam_phone: $("#fam_phone").val(),
        fam_relation: relation,
        fam_dob: $("#fam_dob").val(),
        fam_education: $("#fam_education").val(),
        fam_marry: $("#fam_marry").val()
    },function(res){
        if(res.trim()=="success"){
            alert("Updated Successfully!");
            location.reload();
        } else {
            alert("Update Failed!");
        }
    });
}



function deleteFamily(id){
    if(confirm("Delete this family member?")){
        $.post("deleteFamily.php",{id:id},function(res){
            if(res.trim()=="success"){
                $("#famRow"+id).fadeOut();
            } else {
                alert("Delete Failed!");
            }
        });
    }
}

function checkRelation() {
    let rel = document.getElementById("fam_relation").value;
    let box = document.getElementById("otherRelationBox");

    if (rel === "Other") {
        box.classList.remove("d-none");
        document.getElementById("other_relation").required = true;
    } else {
        box.classList.add("d-none");
        document.getElementById("other_relation").required = false;
    }
}

</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
