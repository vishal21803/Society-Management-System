



<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex">
    <?php include('adminDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         

            <?php
            $result = mysqli_query($con, "SELECT * FROM downloads ORDER BY id DESC");
            ?>
            <a href="add_download.php"><button class="btn btn-success btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#addZoneModal">
        + Add Download
    </button></a>
             

<div class="table-responsive">
    <table class="table table-hover align-middle text-center glass-table" id="myTable">
        <thead>
            <tr>
                <th>ID</th>
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
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i++; // increment counter
?>
    <tr>
        <td><?= $i ?></td>
        <td><?= htmlspecialchars($row['topic']) ?></td>
        <td><?= htmlspecialchars($row['remark']) ?></td>
        <td>
            <a href="upload/<?= $row['file_name'] ?>" target="_blank" class="btn btn-sm btn-view">
                View
            </a>
        </td>
        <td><?= htmlspecialchars($row['downshow']) ?></td>
        <td><?= date("d-M-Y", strtotime($row['created_at'])) ?></td>
        <td>
            <a href="edit_download.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-edit">Edit</a>
            <a href="delete_download.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure you want to delete this file?')">Delete</a>
        </td>
    </tr>
<?php } ?>

        </tbody>
    </table>
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






