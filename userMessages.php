<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user') {
    include("header.php");
    include("connectdb.php");
?>

<main>
<div class="d-flex">

    <?php include('userDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">📩 My Inbox</h3>
            <a href="userChat.php" class="btn btn-success btn-lg animate-btn">+ Message</a>
        </div>

        <div class="row g-4">

            <?php
            $uid = $_SESSION['uid'];
            $q = mysqli_query($con,"
                SELECT * FROM sens_messages 
                WHERE receiver_id='$uid' AND receiver_type='user'
                ORDER BY id DESC
            ");

            if(mysqli_num_rows($q) > 0){
                $delay = 0;
                while($row = mysqli_fetch_assoc($q)){
                    $delay += 0.1;
            ?>

            <div class="col-md-6">
                <div class="message-card p-4 rounded shadow bg-white animate-message" style="animation-delay:<?= $delay ?>s">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold mb-0"><?= htmlspecialchars($row['subject']) ?></h5>
                        <?php if($row['status']=='unread'){ ?>
                            <span class="badge bg-danger">NEW</span>
                        <?php } ?>
                    </div>

                    <p class="mb-2"><?= substr(htmlspecialchars($row['message']),0,120) ?>...</p>

                    <small class="text-muted">Received on: <?= date("d M Y h:i A",strtotime($row['created_at'])) ?></small>

                    <div class="mt-3 text-end">
                        <a href="deleteMessage.php?id=<?= $row['id'] ?>" 
                           class="btn btn-outline-danger btn-sm"
                           onclick="return confirm('Delete message?')">Delete</a>
                    </div>
                </div>
            </div>

            <?php }} else { ?>
            <div class="col-12 text-center">
                <h5>No Messages Available</h5>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
</main>

<style>
/* Glass-like card style with animation */
.message-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
}

.message-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 35px rgba(0,0,0,0.2);
}

.badge {
    font-size: 0.8rem;
    padding: 4px 10px;
}

.animate-message {
    opacity: 0;
    transform: translateY(30px);
    animation: slideIn 0.6s forwards;
}

@keyframes slideIn {
    to { opacity: 1; transform: translateY(0); }
}

.animate-btn {
    transition: 0.3s;
}

.animate-btn:hover {
    transform: scale(1.05);
}
</style>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
