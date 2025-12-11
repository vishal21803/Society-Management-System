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

        <!-- CARD WRAPPER -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-chat-left-dots-fill me-2"></i> Contact Queries</span>
            </div>

            <div class="card-body">
                <div class="table-responsive mobile-table">
                      <button class="btn btn-danger mb-3" id="deleteSelected">
    Delete Selected
</button>

                    <table id="myTable" class="table table-bordered table-hover align-middle w-100">
                        <thead class="table-dark">
                            <tr>
                                            <th><input type="checkbox" id="selectAll"></th>

                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $i = 1;
                            $query = "SELECT * FROM sens_contact ORDER BY con_id DESC";
                            $result = mysqli_query($con, $query);

                            while($row = mysqli_fetch_assoc($result)) { ?>
                               <tr>
    <td><input type="checkbox" class="row-check" value="<?= $row['con_id'] ?>"></td>
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($row['con_name']) ?></td>
    <td><?= htmlspecialchars($row['con_phone']) ?></td>
    <td><?= substr(htmlspecialchars($row['con_desc']), 0, 40) ?>...</td>

    <td>
        <button title="Delete" class="btn btn-sm btn-danger singleDelete"
            data-id="<?= $row['con_id'] ?>">
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
</main>


<!-- ===================== VIEW MESSAGE MODAL ===================== -->
<!-- <div class="modal fade" id="viewMsgModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Message Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><strong>Name:</strong> <span id="msgName"></span></p>
        <p><strong>Phone:</strong> <span id="msgPhone"></span></p>
        <p><strong>Message:</strong><br> 
            <span id="msgDesc" class="d-block mt-2"></span>
        </p>
      </div>

    </div>
  </div>
</div> -->


<!-- ===================== DELETE SCRIPT ===================== -->
<script>
document.addEventListener("DOMContentLoaded", function() {

    // VIEW MODAL FUNCTION
    // document.querySelectorAll('.viewBtn').forEach(btn => {
    //     btn.addEventListener('click', function() {
    //         document.getElementById('msgName').innerText = this.dataset.name;
    //         document.getElementById('msgPhone').innerText = this.dataset.phone;
    //         document.getElementById('msgDesc').innerText = this.dataset.message;

    //         let modal = new bootstrap.Modal(document.getElementById('viewMsgModal'));
    //         modal.show();
    //     });
    // });

    // DELETE FUNCTION
    // document.querySelectorAll('.deleteBtn').forEach(btn => {
    //     btn.addEventListener('click', function() {

    //         if(confirm("Are you sure you want to delete this message?")) {

    //             let id = this.dataset.id;

    //             window.location.href = "delete_contact.php?id=" + id;
    //         }

    //     });
    // });
    $(document).ready(function() {

    // Select / Unselect All
    $("#selectAll").click(function () {
        $(".row-check").prop('checked', this.checked);
    });

    $(".row-check").change(function(){
        if ($(".row-check:checked").length == $(".row-check").length) {
            $("#selectAll").prop("checked", true);
        } else {
            $("#selectAll").prop("checked", false);
        }
    });

    // Bulk Delete
    $("#deleteSelected").click(function () {

        let ids = [];
        $(".row-check:checked").each(function () {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            alert("Please select at least one record!");
            return;
        }

        if (!confirm("Delete " + ids.length + " selected records?")) return;

        window.location.href = "deleteMultipleContact.php?ids=" + ids.join(",");
    });

    // Single delete button
    $(".singleDelete").click(function () {
        if (confirm("Delete this message?")) {
            let id = $(this).data("id");
            window.location.href = "delete_contact.php?id=" + id;
        }
    });

});


});


</script>

<?php
include("footer.php");

} else {
    include("index.php");
}
?>
