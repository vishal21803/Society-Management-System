<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">


        <!-- ✅ SAME CARD DESIGN AS EVENTS -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-download me-2"></i> Manage Downloads</span>

                <a href="add_download.php">
                    <button class="btn btn-success btn-sm">
                        + Add Download
                    </button>
                </a>
            </div>

            <div class="card-body table-responsive">

                <!-- ✅ DATA FETCH -->
                <?php
                $result = mysqli_query($con, "SELECT * FROM downloads ORDER BY id DESC");
                ?>

                <!-- ✅ SAME TABLE STYLE -->
                <table class="table table-bordered table-hover align-middle text-center w-100" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Topic</th>
                            <th>Remark</th>
                            <th>File</th>
                            <th>Show To</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>

                            <td><?= htmlspecialchars($row['topic']) ?></td>

                            <td><?= htmlspecialchars($row['remark']) ?></td>

                            <td>
                                <a href="upload/<?= $row['file_name'] ?>" 
                                   target="_blank" 
                                   class="btn btn-sm btn-info">
                                    View
                                </a>
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    <?= htmlspecialchars($row['downshow']) ?>
                                </span>
                            </td>

                            <td><?= date("d-M-Y", strtotime($row['created_at'])) ?></td>

                            <td>
                                <a href="edit_download.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-sm btn-success">
                                    Edit
                                </a>

                                <a href="delete_download.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-sm btn-danger"
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
