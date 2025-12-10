<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user') {
    include("header.php");
    include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include('userDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-chat-dots me-2"></i> My Messages</span>

                <a href="userChat.php" class="btn btn-success btn-sm">
                    + New Message
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive mobile-table">

                    <table id="myTable" class="table table-bordered table-hover align-middle w-100">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        $i = 1;
                        $uid = $_SESSION['uid'];

                        $q = mysqli_query($con,"
                            SELECT * FROM sens_messages 
                            WHERE receiver_id='$uid' 
                                AND receiver_type='user'
                            ORDER BY id DESC
                        ");

                        if(mysqli_num_rows($q) > 0){
                        while($row = mysqli_fetch_assoc($q)) {

                            // Who sent it?
                            $from = ($row['sender_id'] == 0) ? "Admin" : "User";
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>

                                <td><?= $from ?></td>

                                <td><?= htmlspecialchars($row['subject']) ?></td>

                                <td><?= strlen($row['message']) > 50 
                                        ? htmlspecialchars(substr($row['message'],0,50)) . "..." 
                                        : htmlspecialchars($row['message']); ?>
                                </td>

                                <td><?= date("d M Y H:i", strtotime($row['created_at'])) ?></td>

                                <td>
                                    <a href="deleteMessage.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete this message?');">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        <?php }} else { ?>
                            <tr>
                                <td colspan="6" class="text-center text-danger">
                                    No Messages Found
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
