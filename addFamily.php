<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user'){
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include("userDashboard.php"); ?>

    <div class="flex-grow-1 p-4">

        <div class="card shadow border-0">
            <div class="card-header bg-warning fw-bold">
                <i class="bi bi-person-plus-fill me-2"></i> Add Family Member
            </div>

            <div class="card-body">

                <form action="saveFamily.php" method="POST">

                    <div class="row">

                        

                        <!-- FAMILY NAME -->
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Family Member Name</label>
                            <input type="text" name="fam_name" class="form-control" required>
                        </div>

                        <!-- GENDER -->
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Gender</label>
                            <select name="fam_gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Phone</label>
    <input type="number" 
    name="fam_phone"
       class="form-control" 
       placeholder="Phone Number" 
       id="fam_phone"
       required 
       oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">                           </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">DOB</label>
                            <input type="date" name="fam_dob" class="form-control" >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Education</label>
                            <input type="text" name="fam_edu" class="form-control" >
                        </div>

                         <div class="col-md-6 mb-3">
                            <label class="fw-semibold">Marital Status</label>
                               <select name="fam_marry" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="Married">Married</option>
                                <option value="Unmarried">Unmarried</option>
                            </select>
                        </div>

                       <div class="col-md-12 mb-3">
    <label class="fw-semibold">Relation</label>

    <select name="fam_relation" id="relationSelect" class="form-select" onchange="checkRelation()" required>
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

<!-- Hidden textbox -->
<div class="col-md-12 mb-3 d-none" id="otherRelationBox">
    <label class="fw-semibold">Enter Relation</label>
    <input type="text" name="other_relation" id="other_relation" class="form-control" placeholder="Write relation...">
</div>


                    </div>

                    <button class="btn btn-success">Save Family Member</button>

                </form>

            </div>
        </div>

    </div>

</div>

<!-- SUCCESS MODAL -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">
            <i class="bi bi-check-circle-fill me-2"></i> Success
        </h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <h5 class="fw-bold text-success">Family Member Added Successfully!</h5>
        <p class="text-muted">Your family details have been saved.</p>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">
            OK
        </button>
      </div>

    </div>
  </div>
</div>

</main>

<script>
function checkRelation() {
    let rel = document.getElementById("relationSelect").value;
    let box = document.getElementById("otherRelationBox");

    if (rel === "Other") {
        box.classList.remove("d-none");
        document.getElementById("other_relation").required = true;
    } else {
        box.classList.add("d-none");
        document.getElementById("other_relation").required = false;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get("success") == "1") {
        let myModal = new bootstrap.Modal(document.getElementById("successModal"));
        myModal.show();
    }
});

</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
