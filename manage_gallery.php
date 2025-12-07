<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin') {
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
                <span><i class="bi bi-images me-2"></i> Manage Gallery</span>

                <a href="gallery_form.php">
                    <button class="btn btn-success btn-sm">
                        + Add Gallery
                    </button>
                </a>
            </div>

            <div class="card-body table-responsive">

                <!-- ✅ SAME TABLE STYLE -->
                <table id="myTable" class="table table-bordered table-hover align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Visibility</th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $i = 1;
                        $query = "SELECT * FROM sens_gallery ORDER BY gallery_id DESC";
                        $result = mysqli_query($con, $query);

                        while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                  <td>
                                    <?php if($row['image']) { ?>
                                        <button class="btn btn-sm btn-info viewImageBtn"
                                            data-src="upload/gallery/<?= $row['image'] ?>">
                                            View
                                        </button>
                                    <?php } else { ?>
                                        <span class="text-muted">No Image</span>
                                    <?php } ?>
                                </td>

                                <td><?= htmlspecialchars($row['title']) ?></td>


                                <td>
                                    <span class="badge bg-info">
                                        <?= ucfirst($row['visibility_type']) ?>
                                    </span>
                                </td>

                              

                                <td>
                                    <button class="btn btn-sm btn-success editBtn"
                                        data-id="<?= $row['gallery_id'] ?>">
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-danger deleteBtn"
                                        data-id="<?= $row['gallery_id'] ?>">
                                        Delete
                                    </button>
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

<!-- ✅ IMAGE VIEW MODAL (UNCHANGED, CLEAN LOOK) -->
<div class="modal fade" id="imageViewModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Gallery Image</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <img id="fullImagePreview" src="" class="img-fluid rounded shadow">
      </div>

    </div>
  </div>
</div>

<?php
include("footer.php");
} else {
    include("index.php");
}
?>
