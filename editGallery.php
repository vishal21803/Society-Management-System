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

        <!-- Gallery Listing -->
        <div class="container mt-4">
            <div class="row">
                <?php
                $res = mysqli_query($con,"SELECT * FROM gallery ORDER BY created_at DESC");
                while($row = mysqli_fetch_assoc($res)){
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm animate__animated animate__fadeInUp">
                        <img src="upload/gallery/<?php echo $row['image']; ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text"><?php echo substr($row['description'],0,50); ?>...</p>
                            <button class="btn btn-sm btn-warning" onclick="editGallery(<?php echo $row['gallery_id']; ?>)">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- ================= EDIT MODAL ================= -->
        <div class="modal fade" id="editGalleryModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content animate__animated animate__zoomIn">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="editGalleryForm" enctype="multipart/form-data">

                            <input type="hidden" name="gallery_id" id="edit_gallery_id">

                            <div class="form-floating mb-3">
                                <input type="text" name="title" id="edit_title" class="form-control">
                                <label>Gallery Title</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea name="description" id="newsText" class="form-control" style="height:120px"></textarea>
                                <label>Description</label>
                            </div>

                            <button type="button" onclick="hinglishToHindi()" class="btn btn-warning btn-sm">
    Hinglish → Hindi
</button>
<button type="button" onclick="autoTranslateHindi()" class="btn btn-warning btn-sm">
    Translate to Hindi
</button> 


                            <div class="mb-3">
                                <label>Visibility</label>
                                <select name="visibility" id="edit_visibilityType" class="form-select" onchange="toggleEditTargetSelect()">
                                    <option value="all">All</option>
                                    <option value="zone">Zone</option>
                                    <option value="city">City</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="edit_zoneBox">
                                <select name="zone_id" id="edit_zone_id" class="form-select">
                                    <option value="">Select Zone</option>
                                    <?php
                                    $z=mysqli_query($con,"SELECT * FROM zones");
                                    while($r=mysqli_fetch_assoc($z)){
                                        echo "<option value='{$r['zone_id']}'>{$r['zone_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="edit_cityBox">
                                <select name="city_id" id="edit_city_id" class="form-select">
                                    <option value="">Select City</option>
                                    <?php
                                    $c=mysqli_query($con,"SELECT * FROM cities");
                                    while($r=mysqli_fetch_assoc($c)){
                                        echo "<option value='{$r['city_id']}'>{$r['city_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="edit_memberBox">
                                <select name="member_id" id="edit_member_id" class="form-select">
                                    <option value="">Select Member</option>
                                    <?php
                                    $m=mysqli_query($con,"SELECT member_id, fullname FROM members");
                                    while($r=mysqli_fetch_assoc($m)){
                                        echo "<option value='{$r['member_id']}'>{$r['fullname']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label>Gallery Image</label>
                                <div class="border p-3 text-center" onclick="document.getElementById('edit_galleryImg').click()">
                                    Click to Upload
                                    <img id="edit_galleryPreview" style="width:220px;display:none;margin-top:10px;">
                                </div>
                                <input type="file" name="image" id="edit_galleryImg" hidden onchange="previewEditGallery(event)">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Update</button>
                            <div id="editGalleryMsg" class="mt-3"></div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
</main>

<!-- ================= JAVASCRIPT ================= -->
<script>

function toggleEditTargetSelect(){
    var type = document.getElementById('edit_visibilityType').value;

    document.getElementById('edit_zoneBox').classList.add('d-none');
    document.getElementById('edit_cityBox').classList.add('d-none');
    document.getElementById('edit_memberBox').classList.add('d-none');

    if(type=='zone') document.getElementById('edit_zoneBox').classList.remove('d-none');
    if(type=='city') document.getElementById('edit_cityBox').classList.remove('d-none');
    if(type=='member') document.getElementById('edit_memberBox').classList.remove('d-none');
}

function previewEditGallery(event){
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('edit_galleryPreview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

function editGallery(id){
    $.post('get_gallery.php',{id:id},function(data){
        var g = JSON.parse(data);

        $('#edit_gallery_id').val(g.gallery_id);
        $('#edit_title').val(g.title);
        $('#newsText').val(g.description);
        $('#edit_visibilityType').val(g.visibility).trigger('change');

        $('#edit_zone_id').val(g.zone_id);
        $('#edit_city_id').val(g.city_id);
        $('#edit_member_id').val(g.member_id);

        if(g.image){
            $('#edit_galleryPreview').attr('src','upload/gallery/'+g.image).show();
        }

        $('#editGalleryModal').modal('show');
    });
}

$('#editGalleryForm').submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url:'update_gallery.php',
        type:'POST',
        data: formData,
        contentType:false,
        processData:false,
        success:function(res){
            $('#editGalleryMsg').html(res);
            setTimeout(()=>{
                $('#editGalleryModal').modal('hide');
                location.reload();
            },1500);
        }
    });
});

</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
