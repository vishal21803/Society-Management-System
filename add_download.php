
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex min-vh-200 bg-gradient">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 d-flex justify-content-center align-items-center p-4">

        <div class="upload-card animate-entry">

            <h4 class="text-center mb-4 fw-bold">📁 Upload Download File</h4>

           <form action="save_download.php" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label">Topic</label>
        <input type="text" name="topic" required class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Remark</label>
        <input type="text" name="remark" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Select Type</label>
        <select name="type" class="form-control" required>
            <option value="">-- Select --</option>
            <option value="members">Members</option>
            <option value="general">General</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Select File</label>
        <input type="file" name="file" required class="form-control">
    </div>

    <button type="submit" class="btn btn-glow w-100 mt-3">
        Save File
    </button>

</form>

        </div>

    </div>
</div>


</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
