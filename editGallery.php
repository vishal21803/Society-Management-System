<?php
include("connectdb.php");

if(isset($_GET['id'])){
    $id = intval($_GET['id']); // sanitize input
    $res = mysqli_query($con,"SELECT * FROM gallery WHERE gallery_id='$id'");
    if(mysqli_num_rows($res) == 0){
        echo "<script>alert('Record not found');</script>";
        exit;
    }
    $row = mysqli_fetch_assoc($res);
?>

<!-- Bootstrap Modal -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Edit Gallery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="gallery_id" value="<?= $row['gallery_id'] ?>">

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($row['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?= htmlspecialchars($row['description']) ?></textarea>
            </div>

          
                        <!-- VISIBILITY -->
                        <div class="mb-3 animate__animated animate__fadeInUp">
                            <label class="fw-semibold">Visibility</label>
                            <select name="visibility" id="visibilityType" class="form-select" required>
                                <option value="all">All Members</option>
                                <option value="zone">By Zone</option>
                                <option value="city">By City</option>
                                <option value="member">Single Member</option>
                            </select>
                        </div>

                        <!-- ZONE -->
                        <div class="mb-3 d-none" id="zoneBox">
                            <label>Choose Zone</label>
                            <select name="zone_id" class="form-select">
                                <option value="">Select Zone</option>
                                <?php
                                $z = mysqli_query($con,"SELECT * FROM zones");
                                while($r=mysqli_fetch_assoc($z)){
                                    echo "<option value='{$r['zone_id']}'>{$r['zone_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- CITY -->
                        <div class="mb-3 d-none" id="cityBox">
                            <label>Choose City</label>
                            <select name="city_id" class="form-select">
                                <option value="">Select City</option>
                                <?php
                                $c = mysqli_query($con,"SELECT * FROM cities");
                                while($r=mysqli_fetch_assoc($c)){
                                    echo "<option value='{$r['city_id']}'>{$r['city_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- MEMBER -->
                        <div class="mb-3 d-none" id="memberBox">
                            <label>Choose Member</label>
                            <select name="member_id" class="form-select">
                                <option value="">Select Member</option>
                                <?php
                                $m = mysqli_query($con,"SELECT member_id, fullname FROM members");
                                while($r=mysqli_fetch_assoc($m)){
                                    echo "<option value='{$r['member_id']}'>{$r['fullname']}</option>";
                                }
                                ?>
                            </select>
                        </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
                <?php if($row['image']){ ?>
                    <img src="upload/gallery/<?= $row['image'] ?>" width="100" class="mt-2">
                <?php } ?>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('#editForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'update_gallery.php',
            type: 'POST',
            data: formData,
            contentType:false,
            processData:false,
            success:function(res){
                if(res.trim() == 'success'){
                    alert('Gallery updated successfully');
                    location.reload();
                } else {
                    alert('Error updating gallery');
                }
            }
        });
    });
});
</script>

<?php } ?>
