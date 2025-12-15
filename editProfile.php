
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

$uid = $_SESSION['member_id'];

$q = mysqli_query($con,"
    SELECT 
        -- REQUEST DATA
        r.request_id,
        r.status AS request_status,
        r.request_date,
        r.approved_date,

        -- MEMBER DATA
       m.member_id,
m.user_id,
m.zone_id,
m.city_id,
m.plan_id,
m.gender,
m.dob,
m.membership_start,
m.membership_end,
m.phone,
m.address,
m.photo,
m.created_at,
m.fullname,
m.business,
m.education,

        -- USER DATA
        u.id,
        u.name,
        u.email,
        u.role,
        u.onboarding,
        u.password,
        

        -- ZONE & CITY NAMES
        z.zone_name,
        c.city_name

    FROM sens_requests r
    JOIN sens_members m ON r.member_id = m.member_id
    JOIN sens_users u ON m.user_id = u.id
    JOIN sens_zones z ON m.zone_id = z.zone_id
    JOIN sens_cities c ON m.city_id = c.city_id

    WHERE r.member_id = '$uid'
");

$user = mysqli_fetch_assoc($q);

$status = $user['request_status']; // pending / approved / rejected


?>

<main>

<!-- ✅ Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">

      <form method="POST" action="updateProfile.php" enctype="multipart/form-data">

        <div class="modal-header bg-warning">
          <h5 class="modal-title fw-bold">✏️ Update Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

       <div class="row g-3">

  <div class="col-md-6">
    <label class="fw-bold">Full Name</label>
    <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>" readonly>
  </div>

 <div class="col-md-6">
  <label class="fw-bold">Email</label>

  <input type="email"
         name="email"
         id="emailInput"
         class="form-control"
         value="<?= $user['email'] ?>"
         required>

  <input type="hidden" id="currentEmail" value="<?= $user['email'] ?>">

  <small id="emailMsg"></small>
</div>


 <div class="col-md-6">
  <label class="fw-bold">Mobile</label>

  <input type="number" 
         name="phone" 
         value="<?= $user['phone'] ?>"
         class="form-control" 
         placeholder="Phone Number" 
         id="phoneInput"
         required
         oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">

  <input type="hidden" id="currentPhone" value="<?= $user['phone'] ?>">

  <small id="phoneMsg"></small>
</div>

  <div class="col-md-6">
    <label class="fw-bold">Date of Birth</label>
    <input type="date" name="dob" class="form-control" value="<?= $user['dob'] ?>">
  </div>

<div class="col-md-6">
    <label class="fw-bold">Education</label>
    <input type="text" name="education" class="form-control" 
           value="<?= $user['education'] ?>" placeholder="Your Education">
</div>

<div class="col-md-6">
    <label class="fw-bold">Business</label>
    <input type="text" name="business" class="form-control" 
           value="<?= $user['business'] ?>" placeholder="Your Business">
</div>


  <div class="col-12">
    <label class="fw-bold">Address</label>
    <textarea name="address" class="form-control" required><?= $user['address'] ?></textarea>
  </div>

  <div class="col-12">
    <label class="fw-bold">New Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter new password">
  </div>

  <div class="col-12">
    <label class="fw-bold">Update Photo</label>
    <input type="file" name="photo" class="form-control">
  </div>

</div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="update" class="btn btn-success">Save Changes</button>
        </div>

      </form>

    </div>
  </div>
</div>




<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- COVER -->
                <div class="bg-warning p-4 text-center">
                    <img src="upload/member/<?php echo $user['photo']; ?>" 
                         class="rounded-circle border border-4 border-white"
                         width="140" height="140">
                    <h4 class="mt-3 mb-0 text-dark fw-bold">
                        <?php echo $user['fullname']; ?>
                    </h4>

                    <?php if($status=="approved"){ ?>
                        <span class="badge bg-success mt-2 px-3 py-2 fs-6">
                            <i class="bi bi-patch-check-fill"></i> Verified
                        </span>
                    <?php } else if($status=="pending") { ?>
                        <span class="badge bg-danger mt-2 px-3 py-2 fs-6">
                            ⏳ Approval Pending
                        </span>
                    <?php } ?>
                </div>

                <!-- BODY -->
                <div class="card-body bg-light">

                    <div class="row g-4">

                          <div class="col-md-6">
                            <p class="fw-bold mb-1">Name</p>
                            <div class="form-control bg-white">
                                <?php echo $user['fullname']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Email</p>
                            <div class="form-control bg-white">
                                <?php echo $user['email']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Mobile</p>
                            <div class="form-control bg-white">
                                <?php echo $user['phone']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">City</p>
                            <div class="form-control bg-white">
                                <?php echo $user['city_name']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Zone</p>
                            <div class="form-control bg-white">
                                <?php echo $user['zone_name']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Address</p>
                            <div class="form-control bg-white">
                                <?php echo $user['address']; ?>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <p class="fw-bold mb-1">Password</p>
                            <div class="form-control bg-white">
                                <?php echo $user['password']; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="fw-bold mb-1">Registration Date</p>
                            <div class="form-control bg-white">
                                <?php echo date("d M Y",strtotime($user['created_at'])); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
  <p class="fw-bold mb-1">Date of Birth</p>
  <div class="form-control bg-white">
    <?= date("d M Y", strtotime($user['dob'])) ?>
  </div>
</div>

<div class="col-md-6">
  <p class="fw-bold mb-1">Education</p>
  <div class="form-control bg-white">
    <?php echo($user['education']);?>
  </div>
</div>

<div class="col-md-6">
  <p class="fw-bold mb-1">Business</p>
  <div class="form-control bg-white">
    <?php echo($user['business']);?>
  </div>
</div>


                    </div>

                </div>

                <!-- FOOTER -->
                <div class="card-footer bg-white text-center">
                    <button class="btn btn-warning px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">
    <i class="bi bi-pencil-square"></i> Edit Profile
</button>

                </div>

            </div>

        </div>
    </div>

</div>

    </div>
</div>
</main>



<?php if(isset($_GET['updated'])){ ?>
<script>
document.addEventListener("DOMContentLoaded", function(){
    alert("✅ Profile Updated Successfully!");
});
</script>
<?php } ?>

<script>
let phoneValid = true;

document.addEventListener("DOMContentLoaded", function(){

    let modal = document.getElementById('editProfileModal');

    modal.addEventListener('shown.bs.modal', function () {

        let phoneInput   = document.getElementById("phoneInput");
        let phoneMsg     = document.getElementById("phoneMsg");
        let currentPhone = document.getElementById("currentPhone").value.trim();

        phoneInput.addEventListener("input", function () {

            let phone = this.value.trim();

            if(phone.length < 10){
                phoneMsg.innerHTML = "";
                phoneValid = false;
                return;
            }

            /* ✅ SAME NUMBER (NO AJAX) */
            if(phone === currentPhone){
                phoneMsg.innerHTML =
                  "<span class='text-warning fw-bold'>⚠ This phone number is already used by you</span>";
                phoneValid = true;
                return; // ❗ THIS RETURN IS CRITICAL
            }

            /* ❌ CHECK OTHER USERS */
            fetch("checkProfilePhone.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "phone=" + encodeURIComponent(phone)
            })
            .then(res => res.text())
            .then(data => {

                if(data === "other"){
                    phoneMsg.innerHTML =
                      "<span class='text-danger fw-bold'>❌ This phone number is already used by another user</span>";
                    phoneValid = false;
                }else{
                    phoneMsg.innerHTML =
                      "<span class='text-success fw-bold'>✔ Phone number is available</span>";
                    phoneValid = true;
                }
            });
        });
    });

    document.querySelector("#editProfileModal form")
      .addEventListener("submit", function(e){
        if(!phoneValid){
            e.preventDefault();
            alert("❌ Please enter a valid phone number before updating.");
        }
    });
});


let emailValid = true;

document.addEventListener("DOMContentLoaded", function(){

    let modal = document.getElementById('editProfileModal');

    modal.addEventListener('shown.bs.modal', function () {

        let emailInput   = document.getElementById("emailInput");
        let emailMsg     = document.getElementById("emailMsg");
        let currentEmail = document.getElementById("currentEmail").value.trim().toLowerCase();

        emailInput.addEventListener("input", function () {

            let email = this.value.trim().toLowerCase();

            if(email === ""){
                emailMsg.innerHTML = "";
                emailValid = false;
                return;
            }

            /* ✅ SAME EMAIL (NO AJAX) */
            if(email === currentEmail){
                emailMsg.innerHTML =
                  "<span class='text-warning fw-bold'>⚠ This email is already used by you</span>";
                emailValid = true;
                return;
            }

            /* ❌ CHECK OTHER USERS */
            fetch("checkProfileEmail.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "email=" + encodeURIComponent(email)
            })
            .then(res => res.text())
            .then(data => {

                if(data === "other"){
                    emailMsg.innerHTML =
                      "<span class='text-danger fw-bold'>❌ This email is already used by another user</span>";
                    emailValid = false;
                }else{
                    emailMsg.innerHTML =
                      "<span class='text-success fw-bold'>✔ Email is available</span>";
                    emailValid = true;
                }
            });
        });
    });

    /* ❗ FORM SUBMIT BLOCK */
    document.querySelector("#editProfileModal form")
      .addEventListener("submit", function(e){
        if(!emailValid){
            e.preventDefault();
            alert("❌ Please enter a valid email before updating.");
        }
    });
});

</script>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
