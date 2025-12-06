

<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex min-vh-100 bg-gradient">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 d-flex justify-content-center align-items-center p-4">

        <div class="upload-card animate-entry">

            <h4 class="text-center mb-4  fw-bold">✏ Edit Download</h4>

            <?php
            $id = $_GET['id'];
            $res = mysqli_query($con, "SELECT * FROM downloads WHERE id=$id");
            $data = mysqli_fetch_assoc($res);
            ?>

            <form action="update_download.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="mb-3">
                    <label class="form-label ">Topic</label>
                    <input type="text" name="topic" value="<?= $data['topic'] ?>" required
                           class="form-control custom-input">
                </div>

                <div class="mb-3">
                    <label class="form-label ">Remark</label>
                    <input type="text" name="remark" value="<?= $data['remark'] ?>"
                           class="form-control custom-input">
                </div>
                 <div class="mb-3">
        <label class="form-label">Type</label>
        <select name="type" class="form-control custom-input" required>
            <option value="members" <?= ($data['downshow'] == 'members') ? 'selected' : '' ?>>Members</option>
            <option value="general" <?= ($data['downshow'] == 'general') ? 'selected' : '' ?>>General</option>
        </select>
    </div>

                <div class="mb-3">
                    <label class="form-label ">Replace File (Optional)</label>
                    <input type="file" name="file" class="form-control custom-input">
                    <small class=" mt-1 d-block">
                        Current File: <?= $data['file_name'] ?>
                    </small>
                </div>

                <button type="submit" class="btn btn-glow w-100 mt-3">
                    Update File
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
