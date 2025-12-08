<?php
include("header.php");
include("connectdb.php");
?>

<style>
.gallery-img{
    transition: 0.3s ease;
}
.gallery-img:hover{
    transform: scale(1.05);
}
</style>

<main class="py-5">
<div class="container">

    <h2 class="text-center fw-bold mb-4">Image Gallery</h2>

    <div class="row g-3">

    <?php
    $res = mysqli_query($con,"SELECT * FROM sens_gallery ORDER BY created_at DESC");
    while($row = mysqli_fetch_assoc($res)){
    ?>
        <div class="col-6 col-md-4 col-lg-3">
            <img 
                src="upload/gallery/<?= $row['image'] ?>" 
                class="img-fluid rounded shadow gallery-img"
                onclick="openGalleryModal('upload/gallery/<?= $row['image'] ?>')"
                style="cursor:pointer; height:200px; object-fit:cover; width:100%;">
        </div>
    <?php } ?>

    </div>

</div>


<!-- ✅ Image View Modal -->
<div class="modal fade" id="galleryViewModal" tabindex="-1" data-bs-backdrop="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content bg-transparent border-0">

      <!-- ✅ Clicking anywhere EXCEPT image will close -->
      <div class="modal-body p-0 d-flex justify-content-center align-items-center" 
           data-bs-dismiss="modal">
        
        <!-- ✅ STOP CLICK from closing when clicking on image -->
        <img id="galleryBigImage" 
             src="" 
             class="img-fluid"
             onclick="event.stopPropagation();">
      </div>

    </div>
  </div>
</div>


</main>


<script>
function openGalleryModal(img){
    document.getElementById("galleryBigImage").src = img;
    var myModal = new bootstrap.Modal(document.getElementById('galleryViewModal'));
    myModal.show();
}
</script>

<?php
include("footer.php");
?>
