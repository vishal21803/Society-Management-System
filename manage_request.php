
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex">
    <?php include('adminDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container my-5">

    <h3 class="mb-4 animate__animated animate__fadeInDown">Pending Member Requests</h3>

    <div class="row" id="pendingList">

        <?php
        $res = mysqli_query($con,"
            SELECT r.request_id, u.*, m.*
            FROM sens_requests r 
            JOIN sens_members m ON r.member_id = m.member_id
            JOIN sens_users u ON u.id = m.user_id
            WHERE r.status='pending'
            ORDER BY r.request_date DESC
        ");

       ?>
       <?php 
while($row = mysqli_fetch_array($res)){
    $age = date_diff(date_create($row['dob']), date_create('today'))->y;
?>
<div class="col-12 mb-3 animate__animated animate__fadeInUp">

    <div class="insta-request-card d-flex align-items-center justify-content-between p-3 shadow-sm">

        <!-- LEFT: PROFILE -->
        <div class="d-flex align-items-center gap-3">
            <img src="upload/member/<?php echo $row['photo']; ?>" class="insta-avatar">

            <div>
                <h6 class="mb-1 fw-bold"><?php echo $row['fullname']; ?></h6>
                <small class="text-muted">
                    <?php echo $age; ?> yrs • <?php echo $row['email']; ?>
                </small>
            </div>
        </div>

        <!-- RIGHT: BUTTONS -->
        <div class="d-flex gap-2">
            <button 
                class="btn btn-sm btn-outline-primary viewProfileBtn"
                data-member="<?php echo $row['member_id']; ?>" 
                data-request="<?php echo $row['request_id']; ?>">
                View Profile
            </button>

             <button type="button" class="btn btn-success" id="approveBtn">Approve</button>
        <button type="button" class="btn btn-danger" id="rejectBtn">Reject</button>
        </div>

    </div>

</div>
<?php } ?>

    </div>
</div>

<!-- Modal for member details -->
<div class="modal fade" id="memberModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content animate__animated animate__zoomIn">
      <div class="modal-header">
        <h5 class="modal-title">Member Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="memberDetails">
        <!-- Filled by AJAX -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="approveBtn">Approve</button>
        <button type="button" class="btn btn-danger" id="rejectBtn">Reject</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>

</main>


<script>
document.addEventListener("click", function(e){

    // ✅ APPROVE
    if(e.target.classList.contains("approveBtn")){
        let requestId = e.target.getAttribute("data-request");

        if(confirm("Approve this member?")){
            fetch("requestAction.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "action=approve&request_id=" + requestId
            })
            .then(res => res.text())
            .then(data => {
                alert(data);
                location.reload();
            });
        }
    }

    // ❌ REJECT
    if(e.target.classList.contains("rejectBtn")){
        let requestId = e.target.getAttribute("data-request");

        if(confirm("Reject this member?")){
            fetch("requestAction.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "action=reject&request_id=" + requestId
            })
            .then(res => res.text())
            .then(data => {
                alert(data);
                location.reload();
            });
        }
    }

});
</script>


<?php
include("footer.php");
}else{
    include("index.php");
}
?>
