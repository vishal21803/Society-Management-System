
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
         <div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg animate__animated animate__fadeInUp border-warning">

                <!-- HEADER -->
                <div class="card-header bg-warning text-dark fw-bold text-center">
                    <i class="bi bi-images"></i> Add Gallery Image
                </div>

                <!-- BODY -->
                <div class="card-body">

                    <form id="galleryForm" enctype="multipart/form-data">

                        <!-- TITLE -->
                        <div class="form-floating mb-3 animate__animated animate__fadeInLeft">
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                            <label>Gallery Title</label>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-floating mb-3 animate__animated animate__fadeInRight">
                            <textarea id="newsText" name="description" class="form-control" style="height:120px" placeholder="Desc" ></textarea>
                            <label>Description</label>
                        </div>
                        <button type="button" onclick="hinglishToHindi()" class="btn btn-warning btn-sm">
    Hinglish → Hindi
</button>
<button type="button" onclick="autoTranslateHindi()" class="btn btn-warning btn-sm">
    Translate to Hindi
</button> 
                       <br><br>
                   <div class="form-floating mb-3 animate__animated animate__fadeInLeft">
                            <input type="text" name="priority" class="form-control"  required>
                            <label>Priority</label>
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
                                $z = mysqli_query($con,"SELECT * FROM sens_zones where zstatus=1");
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
                                $c = mysqli_query($con,"SELECT * FROM sens_cities where cstatus=1");
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
                                $m = mysqli_query($con,"SELECT member_id, fullname FROM sens_members");
                                while($r=mysqli_fetch_assoc($m)){
                                    echo "<option value='{$r['member_id']}'>{$r['fullname']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- IMAGE -->
                        <div class="mb-4 animate__animated animate__zoomIn">
                            <label class="fw-semibold">Gallery Image</label>
                            <div class="upload-box text-center border p-3 rounded" onclick="document.getElementById('galleryImg').click()">
                                <i class="bi bi-cloud-upload fs-2"></i>
                                <p class="mb-0">Click to Upload</p>
                                <img id="galleryPreview" class="mt-2" style="width:220px;display:none;">
                            </div>
                            <input type="file" id="galleryImg" name="image" hidden onchange="previewGallery(event)" required>
                        </div>

                        <!-- SUBMIT -->
                        <div class="d-grid">
                            <button class="btn btn-lg text-white" style="background:var(--green);">
                                <i class="bi bi-save"></i> Save Gallery
                            </button>
                        </div>

                        <div id="galleryMsg" class="mt-3"></div>

                    </form>

                </div>
            </div>
        </div>
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
