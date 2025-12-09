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

        <!-- ✅ CARD STYLE SAME AS GALLERY -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-chat-dots me-2"></i> User Messages</span>
            </div>

            <div class="card-body">
    <div class="table-responsive mobile-table">

                <table id="myTable" class="table table-bordered table-hover align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
$q = mysqli_query($con,"
    SELECT m.*, u.name
    FROM sens_messages m
    LEFT JOIN sens_users u ON m.sender_id = u.id
    WHERE m.receiver_type='admin'
    ORDER BY m.id DESC
");
                        while($row = mysqli_fetch_assoc($q)) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
<td><?= $row['name'] ? $row['name'] : 'Unknown User' ?></td>
                            <td><?= htmlspecialchars($row['subject']) ?></td>
                            <td><?= substr(htmlspecialchars($row['message']),0,50) ?>...</td>
                            <td><?= date("d M Y H:i",strtotime($row['created_at'])) ?></td>
                            <td>
                                <!-- View Modal Trigger -->
                                

                                <a title="Reply" href="adminChat.php?id=<?= $row['sender_id'] ?>" 
                                   class="btn btn-sm btn-success"><i class="bi bi-chat-dots"></i>
</a>

                                <a title="Delete" href="deleteMessage.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this message?');">
                                   <i class="bi bi-trash"></i>

                                </a>
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





<?php
include("footer.php");
} else {
    include("index.php");
}
?>
