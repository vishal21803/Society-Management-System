
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex min-vh-100 bg-gradient">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4 d-flex justify-content-center align-items-start">

        <div class="download-card animate-entry w-100">

            <h4 class="text-center mb-4 e fw-bold">📂 Manage Downloads</h4>

            <?php
            $result = mysqli_query($con, "SELECT * FROM downloads ORDER BY id DESC");
            ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center glass-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Topic</th>
                            <th>Remark</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="table-row-animate">
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['topic'] ?></td>
                                <td><?= $row['remark'] ?></td>
                                <td>
                                    <a href="upload/<?= $row['file_name'] ?>" target="_blank"
                                       class="btn btn-sm btn-view">
                                        View
                                    </a>
                                </td>
                                <td>
                                    <a href="edit_download.php?id=<?= $row['id'] ?>"
                                       class="btn btn-sm btn-edit">
                                        Edit
                                    </a>

                                    <a href="delete_download.php?id=<?= $row['id'] ?>"
                                       class="btn btn-sm btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this file?')">
                                        Delete
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
