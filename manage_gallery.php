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

        <h2>Manage Gallery</h2>
                    <a href="gallery_form.php" class="btn btn-success btn-sm">+ Add Gallery</a>

        <table id="myTable" class="display table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Visibility</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
                $query = "SELECT * FROM gallery";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)) { $i++;?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= $row['visibility_type'] ?></td>
                        <td>
                            <?php if($row['image']) { ?>
                                <button class="btn btn-sm btn-info viewImageBtn" data-src="upload/gallery/<?= $row['image'] ?>">View</button>
                            <?php } else { echo "No Image"; } ?>
                        </td>
                        <td>
                            <button class="editBtn btn btn-primary" data-id="<?= $row['gallery_id'] ?>">Edit</button>
                            <button class="deleteBtn btn btn-danger" data-id="<?= $row['gallery_id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
</main>

<!-- Image Modal -->
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

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#myTable').DataTable();

    // DELETE button
    $('#myTable').on('click', '.deleteBtn', function(){
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.post('delete_gallery.php', {id: id}, function(response){
                    if(response.trim() == 'success'){
                        Swal.fire('Deleted!','Record has been deleted.','success').then(()=> location.reload());
                    } else {
                        Swal.fire('Error!','Could not delete.','error');
                    }
                });
            }
        });
    });

    // EDIT button
    $('#myTable').on('click', '.editBtn', function(){
        var id = $(this).data('id');
        $.get('editGallery.php', {id:id}, function(data){
            $('body').append(data);
            $('#editModal').modal('show');
            $('#editModal').on('hidden.bs.modal', function(){ $(this).remove(); });
        });
    });

    // VIEW IMAGE button
    $('#myTable').on('click', '.viewImageBtn', function(){
        var src = $(this).data('src');
        $('#fullImagePreview').attr('src', src);
        $('#imageViewModal').modal('show');
    });

});
</script>

<?php
include("footer.php");
} else {
    include("index.php");
}
?>
