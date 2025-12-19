<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include('userDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="card shadow border-0">
            
            <div class="card-header bg-warning fw-bold text-dark">
                <i class="bi bi-plus-circle me-2"></i> Add Requirement
            </div>

            <div class="card-body">

                <form action="insertRequirement.php" method="POST" enctype="multipart/form-data">

                    <div class="row">

                       

                       <div class="col-md-6 mb-3">
    <label class="form-label">Category</label>

    <select name="category" id="category" 
            class="form-select" required onchange="checkCategory()">
        <option value="">Select</option>
        <option value="Kirana">Kirana</option>
        <option value="Restaurant">Restaurant</option>
        <option value="Hotel">Hotel</option>
        <option value="Sanitary">Sanitary</option>
        <option value="Education">Education</option>
        <option value="Other">Other</option>
    </select>
</div>

<!-- hidden textbox -->
<div class="col-md-6 mb-3 d-none" id="otherBox">
    <label class="form-label">Requirement Type</label>
    <input type="text" name="other_category" id="other_category" 
           class="form-control" placeholder="Write category...">
</div>

                       

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Requirement Description</label>
                            <textarea class="form-control" name="details" rows="3" placeholder="About Requirement..." required></textarea>
                        </div>

                      <div class="col-md-6 mb-3">
    <label class="form-label">Requirement Date</label>
    <input type="date" 
           name="require_date" 
           
           value="<?= date('Y-m-d'); ?>"
           class="form-control"
           required>
</div>

                    </div>

                    <button class="btn btn-success mt-2">Submit</button>
                    <a href="manageServices.php" class="btn btn-secondary mt-2">Cancel</a>

                </form>

            </div>
        </div>

    </div>

</div>
</main>

<script>
    function checkCategory(){

    let cat = document.getElementById("category").value;
    let box = document.getElementById("otherBox");
    let txt = document.getElementById("other_category");

    if(cat === "Other"){
        box.classList.remove("d-none");
        txt.setAttribute("required", "required");
    }
    else{
        box.classList.add("d-none");
        txt.removeAttribute("required");
        txt.value=""; // reset textbox when hiding
    }
}

</script>

<?php include("footer.php");
}else{
    include("index.php");
}
?>
