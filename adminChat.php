
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");

$id = $_REQUEST["id"]; 

$uq = mysqli_query($con,"
    SELECT 
        u.name AS user_name,
        m.member_id,
        z.zone_name,
        c.city_name
    FROM sens_users u
    JOIN sens_members m ON u.id = m.user_id
    JOIN sens_zones z ON m.zone_id = z.zone_id
    JOIN sens_cities c ON m.city_id = c.city_id
    WHERE u.id = '$id'
");

$userData = mysqli_fetch_assoc($uq);
?>

<main>




<div class="d-flex">
    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="send-message-card p-4 rounded shadow bg-white">

            <h3 class="fw-bold mb-4 text-center">✉️ Send a Message</h3>

       <form method="POST" action="adminSend.php?id=<?= $id; ?>">
        <div class="mb-3">
    <label class="fw-bold">To</label>
    <input type="text" 
           class="form-control form-input" 
           value="<?= htmlspecialchars($userData['user_name'] ) , ' ('.htmlspecialchars($userData['zone_name']) , ', '.htmlspecialchars($userData['city_name']).')'?>"
           readonly>
</div>

                <div class="mb-3">
                    <input type="text" name="subject" class="form-control form-input" placeholder="Subject" required>
                </div>

                <div class="mb-3">
                    <textarea name="message" class="form-control form-input" placeholder="Write your message..." rows="6" required></textarea>
                </div>

                <div class="text-center">
                    <button name="send" class="btn btn-gradient btn-lg">Send Message</button>
                </div>
            </form>

        </div>

    </div>
</div>

<style>
/* Glass-like card for form */
.send-message-card {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0,0,0,0.1);
    max-width: 600px;
    margin: 0 auto;
    animation: fadeIn 0.8s ease forwards;
}

/* Inputs style */
.form-input {
    background: rgba(255,255,255,0.85);
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 12px 15px;
    transition: all 0.3s;
}

.form-input:focus {
    border-color: #ff9800;
    box-shadow: 0 4px 12px rgba(255, 152, 0, 0.2);
    outline: none;
}

/* Button gradient */
.btn-gradient {
    background: linear-gradient(135deg, #ff9800, #ff5722);
    color: #fff;
    border-radius: 30px;
    padding: 10px 25px;
    font-weight: bold;
    transition: all 0.3s;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #ff5722, #ff9800);
    transform: scale(1.05);
    color: #fff;
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>




</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
