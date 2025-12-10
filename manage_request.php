<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin') {

include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="card shadow border-0">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people me-2"></i> Pending Member Requests</span>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                            
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php
                        $i = 1;
                        $res = mysqli_query($con,"
                            SELECT r.request_id, u.*, m.*,z.*,c.*,p.*
                            FROM sens_requests r 
                            JOIN sens_members m ON r.member_id = m.member_id
                            JOIN sens_users u ON u.id = m.user_id
                            JOIN sens_zones z ON z.zone_id = m.zone_id
                            JOIN sens_cities c ON c.city_id = m.city_id
                            JOIN sens_plans p ON p.plan_id = m.plan_id


                            WHERE r.status='pending'
                            ORDER BY r.request_date DESC
                        ");

                        while($row = mysqli_fetch_assoc($res)){
                            $age = date_diff(date_create($row['dob']), date_create('today'))->y;
                        ?>
                        <tr>

                            <td><?= $i++ ?></td>

                           

                            <td><?= $row['fullname'] ?></td>

                            <td><?= $row['email'] ?></td>


                            <td>

                                <!-- VIEW PROFILE -->
                                <button class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewModal<?= $row['request_id'] ?>">
                                    View
                                </button>

                                <!-- APPROVE -->
                                <button class="btn btn-sm btn-success approveBtn"
                                        data-request="<?= $row['request_id'] ?>">
                                    Approve
                                </button>

                                <!-- REJECT -->
                                <button class="btn btn-sm btn-danger rejectBtn"
                                        data-request="<?= $row['request_id'] ?>">
                                    Reject
                                </button>

                            </td>

                        </tr>

                        <!-- ============= VIEW MODAL ============= -->
                        <div class="modal fade" id="viewModal<?= $row['request_id'] ?>" tabindex="-1">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">

                              <div class="modal-header bg-warning">
                                <h5 class="modal-title">Member Details</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <div class="modal-body">

                                <div class="row">

                                    <div class="col-md-4 text-center">
                                        <img src="upload/member/<?= $row['photo'] ?>" 
                                             class="rounded-circle mb-3" 
                                             style="width:130px; height:130px;">
                                    </div>

                                    <div class="col-md-8">
                                        <h5><?= $row['fullname'] ?></h5>
                                        <p><b>Email:</b> <?= $row['email'] ?></p>
                                        <p><b>Phone:</b> <?= $row['phone'] ?></p>
                                        <p><b>Zone:</b> <?= $row['zone_name'] ?></p>
                                        <p><b>City:</b> <?= $row['city_name'] ?></p>
                                        <p><b>Plan Details:</b> <?= $row['name'],"(Rs ".($row['price'].")") ?></p>


                                    </div>

                                </div>

                              </div>

                              <div class="modal-footer">
                             
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- ========== END VIEW MODAL ========== -->

                        <?php } ?>

                        </tbody>

                    </table>
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

document.addEventListener("click", function(e){

    /* -------------------------------
       VIEW PROFILE CLICK
    --------------------------------*/
    if (e.target.classList.contains("viewProfileBtn")) {

        let memberId = e.target.getAttribute("data-member");
        let requestId = e.target.getAttribute("data-request");

        // Load details via AJAX
        fetch("fetchMemberDetails.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "member_id=" + memberId + "&request_id=" + requestId
        })
        .then(res => res.text())
        .then(data => {
            document.getElementById("memberDetails").innerHTML = data;

            // Set request id for modal approve/reject buttons
            // document.getElementById("approveBtn").setAttribute("data-request", requestId);
            // document.getElementById("rejectBtn").setAttribute("data-request", requestId);

            // Open modal
            let myModal = new bootstrap.Modal(document.getElementById('memberModal'));
            myModal.show();
        });
    }

});


</script>

<?php include("footer.php"); } else { include("index.php"); } ?>

