
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex">
    <?php include('adminDashboard.php'); ?>

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





    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container my-4">
    <h2 class="text-center mb-4 fw-bold text-warning">Register New Member</h2>

    <!-- Step Progress Indicators -->
    <div class="d-flex justify-content-center mb-4">
        <div id="step1Btn" class="step-indicator active-step">1. Personal</div>
        <div id="step2Btn" class="step-indicator">2. Address</div>
        <div id="step3Btn" class="step-indicator">3. Photo</div>
        
                <div id="step4Btn" class="step-indicator">4. Plans</div>

    </div>

    <form action="saveaddmem.php" method="POST" enctype="multipart/form-data">

        <!-- STEP 1 -->
        <div id="step1" class="step-box">
            <h4 class="text-danger fw-bold mb-3">Personal Details</h4>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>

                <!-- <div class="col-md-6">
                    <label>Login Name</label>
                    <input type="text" name="username" class="form-control" required>
                </div> -->

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                        <small id="emailMsg"></small>

                </div>

                <div class="col-md-12">
                    <label>Phone</label>
<input type="number" 
       name="phone" 
       class="form-control" 
       placeholder="Phone Number" 
       id="phoneInput"
       required 
       oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">                </div>
                
            </div>

            <div class="mb-3 animate-fade">
    <label class="form-label fw-semibold">Date of Birth</label>
    <div class="input-group">
        <span class="input-group-text" style="background:#ffcc66; border:2px solid #ffb84d;">
            <i class="bi bi-calendar-event-fill"></i>
        </span>
        <input type="date" name="dob" class="form-control custom-input" required>
    </div>
</div>


          

            <div class="mb-3">
    <label class="form-label fw-bold">Gender</label>

    <div class="row g-3">
        <div class="col-4">
            <label class="gender-card w-100 text-center" onclick="selectGender(this)">
                <input type="radio" name="gender" value="Male">
                <i class="bi bi-gender-male fs-1 text-primary"></i><br>
                Male
            </label>
        </div>
        <div class="col-4">
            <label class="gender-card w-100 text-center" onclick="selectGender(this)">
                <input type="radio" name="gender" value="Female">
                <i class="bi bi-gender-female fs-1 text-danger"></i><br>
                Female
            </label>
        </div>
        <div class="col-4">
            <label class="gender-card w-100 text-center" onclick="selectGender(this)">
                <input type="radio" name="gender" value="Other">
                <i class="bi bi-person fs-1 text-warning"></i><br>
                Other
            </label>
        </div>
    </div>
</div>

<button type="button" class="btn step-btn" id="goToStep2Btn">Next →</button>
        </div>

        <!-- STEP 2 -->
        <div id="step2" class="step-box" style="display:none;">
            <h4 class="text-success fw-bold mb-3">Address Details</h4>

            <div class="row mb-3">
                <!-- <div class="col-md-4">
                    <label>State</label>
                    <select id="stateDropdown" name="state_id" class="form-select" required onchange="loadZones();">
                        <option value="">Select State</option>
                        <?php
                        $rs = mysqli_query($con,"SELECT * FROM sens_states ORDER BY state_name ASC");
                        while($s = mysqli_fetch_assoc($rs)){
                            echo "<option value='".$s['state_id']."'>".$s['state_name']."</option>";
                        }
                        ?>
                    </select>
                </div> -->

                <div class="col-md-4">
                    <label>Zone</label>
                    <select id="zoneDropdown" name="zone_id" class="form-select" required onchange="loadCities();">
                        <option value="">Select Zone</option>
                            <?php
                        $rs = mysqli_query($con,"SELECT * FROM sens_zones ORDER BY zone_id ASC");
                        while($s = mysqli_fetch_assoc($rs)){
                            echo "<option value='".$s['zone_id']."'>".$s['zone_name']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>City</label>
                    <select id="cityDropdown" name="city_id" class="form-select" required>
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>

            <label>Address</label>
            <textarea name="address" class="form-control mb-3" required></textarea>

            <button type="button" class="btn btn-secondary" onclick="goStep(1,'right')">← Back</button>
            <button type="button" class="btn step-btn" onclick="goStep(3,'left')">Next →</button>
        </div>

        <!-- STEP 3 -->
        <div id="step3" class="step-box" style="display:none;">
            <h4 class="text-primary fw-bold mb-3">Photo Upload</h4>

            <label>Upload Photo</label>
            <input type="file" name="photo" class="form-control mb-3" required>

            <button type="button" class="btn btn-secondary" onclick="goStep(2,'right')">← Back</button>
<button type="button" class="btn step-btn" onclick="goStep(4,'left')">Next →</button>
        </div>

        <!-- STEP 4 -->
<div id="step4" class="step-box" style="display:none;">
    <h4 class="text-warning fw-bold mb-3">Select Membership Plan</h4>

    <div class="row">
        <?php
        $pr = mysqli_query($con,"SELECT * FROM sens_plans");
        while($p = mysqli_fetch_assoc($pr)){
        ?>
        <div class="col-md-6 mb-3">
            <label class="plan-box w-100 p-3 border rounded text-center">
                <input type="radio" name="plan_id" value="<?= $p['plan_id'] ?>" required>
                <h5><?= $p['name'] ?></h5>
                <h6>₹<?= $p['price'] ?></h6>
                <small>
                    <?= ($p['duration_days']) ? $p['duration_days']." Days" : "Lifetime" ?>
                </small>
            </label>
        </div>
        <?php } ?>
    </div>

    <button type="button" class="btn btn-secondary" onclick="goStep(3,'right')">← Back</button>
    <button type="submit" class="btn btn-success">Submit & Send Plan Request</button>
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
    let emailValid = false; // global flag

document.addEventListener("DOMContentLoaded", () => {
    let emailInput = document.querySelector("input[name='email']");
    let nextBtn = document.querySelector("#goToStep2Btn");
    let emailMsg = document.getElementById("emailMsg");

    emailInput.addEventListener("keyup", function() {
        let email = this.value.trim();
        if(email === "") {
            emailMsg.innerHTML = "";
            emailValid = false;
            return;
        }

        fetch("checkEmail.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "email=" + email
        })
        .then(res => res.text())
        .then(data => {
            if(data === "exists"){
                emailMsg.innerHTML = "<span class='text-danger fw-bold'>❌ Email already registered</span>";
                emailValid = false;
            } else {
                emailMsg.innerHTML = "<span class='text-success fw-bold'>✔️ Email available</span>";
                emailValid = true;
            }
        });
    });
});

document.getElementById("goToStep2Btn").addEventListener("click", function () {
    if(emailValid){
        goStep(2,'left');   // move to next step
    } else {
        alert("Email already registered! Please use another email.");
    }
});


</script>
<?php
include("footer.php");
}else{
    include("index.php");
}
?>
