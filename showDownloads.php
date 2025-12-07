<?php
@session_start();
include("header.php");
include("connectdb.php");

$isLogin = isset($_SESSION["uname"]);

if($isLogin){
    // ✅ Logged in → General + Members both
    $sql = "SELECT * FROM sens_downloads WHERE downshow IN ('general','members') ORDER BY id DESC";
}else{
    // ✅ Logged out → Only General
    $sql = "SELECT * FROM sens_downloads WHERE downshow='general' ORDER BY id DESC";
}

$query = mysqli_query($con,$sql);
?>

<style>
.download-section{
    background: linear-gradient(135deg, #fff9e6, #ffe9b3);
    padding: 60px 0;
}
.download-section .container{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.download-title{
    font-size: 2.5rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 40px;
}

.download-card{
    width: 900px;           /* ✅ Fixed width */
    height: 150px;          /* ✅ Fixed height */
    margin: 0 auto 20px;    /* ✅ Center + gap */
    background: rgba(255,255,255,0.85);
    border-radius: 16px;
    padding: 22px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow: 0 12px 32px rgba(0,0,0,0.15);
    transition: 0.4s;

    animation: slideUp 0.7s ease forwards;
    opacity: 0;
}


.download-card:hover{
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 18px 40px rgba(0,0,0,0.25);
}

.download-left h5{
    font-weight: bold;
}

.download-badge{
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 20px;
    background: #ff9800;
    color: #fff;
    margin-left: 10px;
}

.download-date{
    font-size: 13px;
    color: gray;
}

.download-btn{
    background: linear-gradient(135deg, #ff9800, #ff5722);
    color: #fff;
    border-radius: 30px;
    padding: 10px 22px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.download-btn:hover{
    background: linear-gradient(135deg, #ff5722, #ff9800);
    color: #fff;
    transform: scale(1.08);
}

@keyframes slideUp{
    from{opacity:0; transform:translateY(40px);}
    to{opacity:1; transform:translateY(0);}
}
</style>


<main>
<section class="download-section">
<div class="container">

<h2 class="download-title">📂 Society Downloads</h2>

<?php
if(mysqli_num_rows($query) > 0){
    $delay = 0;
    while($row = mysqli_fetch_assoc($query)){
        $delay += 0.1;
?>
    <div class="download-card" style="animation-delay:<?= $delay ?>s">

        <div class="download-left">
            <h5>
                <?= htmlspecialchars($row['topic']) ?>
                <span class="download-badge">
                    <?= strtoupper($row['downshow']) ?>
                </span>
            </h5>

            <p class="mb-1 text-muted">
                <?= htmlspecialchars($row['remark']) ?>
            </p>

            <div class="download-date">
                Uploaded on: <?= date("d M Y", strtotime($row['created_at'])) ?>
            </div>
        </div>

     
            <a href="upload/files/<?= $row['file_name'] ?>" class="download-btn" download>
                ⬇ Download
            </a>
      
      

    </div>
<?php
    }
}else{
?>
    <p class="text-center">No files available</p>
<?php } ?>

</div>
</section>
</main>
<?php include("footer.php"); ?>
