<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

?>

<main>
<div class="d-flex min-vh-100 ">

    <?php include('userDashboard.php'); ?>

    <div class="flex-grow-1 p-4 d-flex justify-content-center align-items-start">

        <div class="download-card animate-entry w-100">

            <h4 class="text-center mb-4  fw-bold">📥 Download Center</h4>

            <?php
            $result = mysqli_query($con, "SELECT * FROM sens_downloads ORDER BY id DESC");
            ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center glass-table">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Remark</th>
                            <th>File</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="table-row-animate">
                                <td><?= $row['topic'] ?></td>
                                <td><?= $row['remark'] ?></td>
                                <td>
                                    <a href="upload/<?= $row['file_name'] ?>" download
                                       class="btn btn-download">
                                       Download
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

</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
