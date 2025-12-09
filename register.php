<?php 
@session_start();
include("header.php");
include("connectdb.php");
?>

<br><br>
<main>
<div class="container my-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark fw-bold text-center fs-4">
            ✅ Register New Member
        </div>

        <div class="card-body p-4">

            <form action="saveusermem.php" method="POST" id="myForm">

                <!-- ✅ Full Name -->
                <div class="mb-3">
                    <label class="fw-bold">Full Name</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>

                <!-- ✅ Email -->
                <div class="mb-3">
                    <label class="fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                        <small id="emailMsg"></small>

                </div>

                <!-- ✅ Phone -->
              <input type="number" 
       name="phone" 
       class="form-control" 
       placeholder="Phone Number" 
       id="phoneInput"
       required 
       oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">   

                <!-- ✅ Zone -->
                <div class="mb-3">
                    <label class="fw-bold">Zone</label>
                    <select name="zone_id" id="zoneDropdown" class="form-select" required onchange="loadCities()">
                        <option value="">-- Select Zone --</option>
                        <?php
                        $rs = mysqli_query($con,"SELECT * FROM sens_zones ORDER BY zone_name ASC");
                        while($z = mysqli_fetch_assoc($rs)){
                            echo "<option value='{$z['zone_id']}'>{$z['zone_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- ✅ City -->
                <div class="mb-3">
                    <label class="fw-bold">City</label>
                    <select name="city_id" id="cityDropdown" class="form-select" required>
                        <option value="">-- Select City --</option>
                    </select>
                </div>

                <!-- ✅ Membership Plan -->
                <div class="mb-4">
                    <label class="fw-bold">Select Membership Plan</label>
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

<script>

let emailValid = false; // global flag

// ----------------------
//  EMAIL CHECK (AJAX)
// ----------------------
document.addEventListener("DOMContentLoaded", () => {

    let emailInput = document.querySelector("input[name='email']");
    let emailMsg = document.getElementById("emailMsg");

    emailInput.addEventListener("keyup", function () {

        let email = this.value.trim();

        if (email === "") {
            emailMsg.innerHTML = "";
            emailValid = false;
            return;
        }

        fetch("checkEmail.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "email=" + email
        })
        .then(res => res.text())
        .then(data => {
            if (data === "exists") {
                emailMsg.innerHTML = "<span class='text-danger fw-bold'>❌ Email already registered</span>";
                emailValid = false;
            } else {
                emailMsg.innerHTML = "<span class='text-success fw-bold'>✔ Email available</span>";
                emailValid = true;
            }
        });
    });
});


// -----------------------------------------------------
//   ON REGISTER BUTTON CLICK → VALIDATE & SUBMIT
// -----------------------------------------------------
document.getElementById("goToStep2Btn").addEventListener("click", function () {

    // List of required fields by NAME
    let requiredFields = [
        "fullname",
        "email",
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

    // If empty fields → stop
    if (!allFilled) {
        alert("Please fill all the required fields!");
        if (firstEmptyField) firstEmptyField.focus();
        return;
    }

    // Email must be valid
    if (!emailValid) {
        alert("Email already registered! Please use another email.");
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


<?php include("footer.php"); ?>
