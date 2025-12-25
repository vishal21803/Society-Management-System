<?php 
@session_start();
if(isset($_SESSION["uname"]) )
{
include("header.php");
include("connectdb.php");

$uid = $_SESSION['uid'];

$q = mysqli_query($con,"
   select * from sens_users where id='$uid'
");

$user = mysqli_fetch_assoc($q);
?>

<main>

<!-- 🔐 CHANGE PASSWORD MODAL -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content shadow border-0">

      <form method="POST" action="updatePassword.php">

        <div class="modal-header bg-warning">
          <h5 class="modal-title fw-bold">🔑 Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <label class="fw-bold">New Password</label>
            <input type="password" 
                   name="new_password" 
                   class="form-control"
                   required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Confirm New Password</label>
            <input type="password" 
                   name="confirm_password" 
                   class="form-control"
                   required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="update" class="btn btn-success">
            Update Password
          </button>
        </div>

      </form>

    </div>
  </div>
</div>


<div class="d-flex">
<?php include('userDashboard.php'); ?>

<div class="flex-grow-1 p-4">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-7">

<div class="card shadow-lg border-0 rounded-4 overflow-hidden">

<!-- COVER -->
<!-- <div class="bg-warning text-center p-4">
  <img src="upload/member/<?php echo $user['photo']; ?>" 
       class="rounded-circle border border-4 border-white"
       width="140" height="140">

  <h4 class="mt-3 fw-bold text-dark">
    <?php echo $user['fullname']; ?>
  </h4>
</div> -->

<!-- BODY -->
<div class="card-body bg-light">

  <div class="mb-3">
    <label class="fw-bold">Full Name</label>
    <div class="form-control bg-white">
      <?php echo $user['name']; ?>
    </div>
  </div>

  <div class="mb-3">
    <label class="fw-bold">Password</label>
    <div class="form-control bg-white">
       <?php echo $user['password']; ?>
    </div>
  </div>

</div>

<!-- FOOTER -->
<div class="card-footer text-center bg-white">
  <button class="btn btn-warning px-4"
          data-bs-toggle="modal"
          data-bs-target="#editProfileModal">
    <i class="bi bi-key"></i> Change Password
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
alert("✅ Password updated successfully!");
</script>
<?php } ?>

<?php
include("footer.php");
}else{
include("index.php");
}
?>
