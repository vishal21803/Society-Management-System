<?php
include("connectdb.php");

$id = intval($_GET['id']);
$res = mysqli_query($con,"SELECT * FROM sens_gallery WHERE gallery_id='$id'");
$row = mysqli_fetch_assoc($res);
?>

<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" enctype="multipart/form-data">

        <div class="modal-header">
          <h5>Edit Gallery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <input type="hidden" name="gallery_id" value="<?= $row['gallery_id'] ?>">
             <label for="">Gallery Title</label>
            <input type="text" name="title" class="form-control mb-2" value="<?= $row['title'] ?>" required>

            <label for="">Gallery Description</label>
            <textarea name="description" class="form-control mb-2" required><?= $row['description'] ?></textarea>

             <label for="">Priority</label>
            <input type="text" name="priority" class="form-control mb-2" value="<?= $row['priority'] ?>" required>

            <!-- ✅ NAME FIXED -->
             <label for="">Visibile to</label>
            <select name="visibility_type" id="visibilityType" class="form-select mb-2">
                <option value="all">All</option>
                <option value="zone">Zone</option>
                <option value="city">City</option>
                <option value="member">Member</option>
            </select>

            <div id="zoneBox" class="d-none mb-2">
                <select name="zone_id" class="form-select">
                    <option value="">Select Zone</option>
                    <?php $z = mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);

                    while($r=mysqli_fetch_assoc($z)){
                        echo "<option value='{$r['zone_id']}'>{$r['zone_name']}</option>";
                    } ?>
                </select>
            </div>

            <div id="cityBox" class="d-none mb-2">
                <select name="city_id" class="form-select">
                    <option value="">Select City</option>
                    <?php $c=mysqli_query($con,"SELECT * FROM sens_cities where cstatus=1");
                    while($r=mysqli_fetch_assoc($c)){
                        echo "<option value='{$r['city_id']}'>{$r['city_name']}</option>";
                    } ?>
                </select>
            </div>

            <div id="memberBox" class="d-none mb-2">
                <select name="member_id" class="form-select">
                    <option value="">Select Member</option>
                    <?php $m=mysqli_query($con,"SELECT * FROM sens_members");
                    while($r=mysqli_fetch_assoc($m)){
                        echo "<option value='{$r['member_id']}'>{$r['fullname']}</option>";
                    } ?>
                </select>
            </div>
            <!-- FRONT PAGE CHECKBOX -->
<div class="form-check mb-3">
    <input type="hidden" name="gallery_front" value="0">

    <input type="checkbox"
           name="gallery_front"
           value="1"
           class="form-check-input"
           id="frontCheck"
           <?= ($row['gallery_front']==1) ? "checked" : "" ?>>

    <label class="form-check-label" for="frontCheck">
        Show on Front Page?
    </label>
</div>


            <label for="">Gallery Image</label>
            <input type="file" name="image" class="form-control mt-2">

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
$('#editForm').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: "update_gallery.php",
        type: "POST",
        data: new FormData(this),
        contentType:false,
        processData:false,
        success:function(res){
            if(res.trim()=="success"){
                alert("Updated Successfully");
                location.reload();
            }else{
                alert(res);
            }
        }
    });
});

// ✅ VISIBILITY TOGGLE
$('#visibilityType').on('change', function(){
    let v = $(this).val();
    $('#zoneBox,#cityBox,#memberBox').addClass('d-none');

    if(v=='zone') $('#zoneBox').removeClass('d-none');
    else if(v=='city') $('#cityBox').removeClass('d-none');
    else if(v=='member') $('#memberBox').removeClass('d-none');
});
</script>
