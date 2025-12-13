
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>

<!-- ✅ Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">✅ Success</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" width="90">
        <h5 class="mt-3 fw-bold text-success">Member Added Successfully!</h5>
        <p class="text-muted">New member has been registered and plan assigned.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>



<div class="d-flex">
    <?php include('adminDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->

        <div class="container my-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark fw-bold text-center fs-4">
            ✅ Register New Member
        </div>

        <div class="card-body p-4">

            <form action="saveaddmem.php" method="POST" enctype="multipart/form-data" id="myForm">

                <!-- ✅ Full Name -->
                <div class="mb-3">
                    <label class="fw-bold">Full Name <span style="color:red">*</span></label>
                    <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                </div>

                  <div class="mb-3">
           <label class="fw-bold" for="">Phone <span style="color:red">*</span></label>
                <!-- ✅ Phone -->
              <input type="number" 
       name="phone" 
       class="form-control" 
       placeholder="Phone Number" 
       id="phoneInput"
       required 
       oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">   
                               <small id="phoneMsg"></small>

       </div>

                <!-- ✅ Email -->
                <div class="mb-3">
                    <label class="fw-bold">Email </label>
                    <input type="email" name="email" placeholder="Email (Optional)" class="form-control" >
                        <small id="emailMsg"></small>

                </div>
              

                <!-- ✅ Zone -->
                <div class="mb-3">
                    <label class="fw-bold">Zone <span style="color:red">*</span></label>
                    <select name="zone_id" id="zoneDropdown" class="form-select" required onchange="loadCities()">
                        <?php
$rs = mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);
                        while($z = mysqli_fetch_assoc($rs)){
                            echo "<option value='{$z['zone_id']}'>{$z['zone_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- ✅ City -->
                <div class="mb-3">
                    <label class="fw-bold">City <span style="color:red">*</span></label>
                    <select name="city_id" id="cityDropdown" class="form-select" required>
                        <option value="">-- Select City --</option>
                    </select>
                </div>

                <!-- ✅ Membership Plan -->
                <div class="mb-4">
                    <label class="fw-bold">Select Membership Plan <span style="color:red">*</span></label>
                    <select name="plan_id" class="form-select" required>
                        <?php
                        $pr = mysqli_query($con,"SELECT * FROM sens_plans order by plan_id desc");
                        while($p = mysqli_fetch_assoc($pr)){
                            echo "<option value='{$p['plan_id']}'>
                                    {$p['name']} - ₹{$p['price']}
                                  </option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- ✅ Submit -->
                <div class="text-center">
                    <button type="button" class="btn step-btn" id="goToStep2Btn">Register</button>

                </div>

            </form>

        </div>
    </div>
</div>



</main>
<?php if(isset($_GET['success']) && $_GET['success']==1){ ?>
<script>
document.addEventListener("DOMContentLoaded", function(){
    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
    myModal.show();
});
</script>
<?php } ?>



<script>

let phoneValid = false; // global flag

// ----------------------
//  PHONE CHECK (AJAX)
// ----------------------
document.addEventListener("DOMContentLoaded", () => {
     loadCities(); // page load hote hi 1st zone ki cities load

    let phoneInput = document.getElementById("phoneInput");
    let phoneMsg = document.getElementById("phoneMsg"); // reuse same <small>

    phoneInput.addEventListener("keyup", function () {

        let phone = this.value.trim();

        if (phone === "" || phone.length < 10) {
            phoneMsg.innerHTML = "";
            phoneValid = true; // empty phone allowed (but you kept required)
            return;
        }

        fetch("checkPhone.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "phone=" + phone
        })
        .then(res => res.text())
        .then(data => {
            if (data === "exists") {
                phoneMsg.innerHTML = "<span class='text-danger fw-bold'>❌ Phone already registered</span>";
                phoneValid = false;
            } else {
                phoneMsg.innerHTML = "<span class='text-success fw-bold'>✔ Phone available</span>";
                phoneValid = true;
            }
        });
    });
});


// -----------------------------------------------------
//   ON REGISTER BUTTON CLICK → VALIDATE & SUBMIT
// -----------------------------------------------------
document.getElementById("goToStep2Btn").addEventListener("click", function () {

    let requiredFields = [
        "fullname",
        "phone",
        "zone_id",
        "city_id",
        "plan_id"
    ];

    let allFilled = true;
    let firstEmptyField = null;

    requiredFields.forEach(function (name) {

        let field = document.querySelector("[name='" + name + "']");

        if (field && field.value.trim() === "") {
            allFilled = false;
            field.classList.add("is-invalid");

            if (!firstEmptyField) {
                firstEmptyField = field;
            }

        } else if (field) {
            field.classList.remove("is-invalid");
        }
    });

    if (!allFilled) {
        alert("Please fill all the required fields!");
        if (firstEmptyField) firstEmptyField.focus();
        return;
    }

    // ------------------------------
    //  PHONE MUST BE UNIQUE
    // ------------------------------
    if (!phoneValid) {
        alert("Phone number already registered! Please use another phone.");
        return;
    }

    // Everything OK → submit form
    document.getElementById("myForm").submit();

});


// -----------------------------------------------------
//   LOAD CITY BASED ON ZONE
// -----------------------------------------------------
function loadCities() {
    let zone = document.getElementById("zoneDropdown").value;

    fetch("fetchCities.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "zone_id=" + zone
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("cityDropdown").innerHTML = data;
    });
}

</script>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
