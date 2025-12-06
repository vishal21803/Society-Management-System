<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<!-- ✅ DATATABLE CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<main>
<div class="d-flex">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">


        <!-- ✅ SAME CARD LAYOUT AS EVENTS -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-newspaper me-2"></i> Manage News</span>

                <a href="newsForm.php">
                    <button class="btn btn-success btn-sm">
                        + Add News
                    </button>
                </a>
            </div>

            <div class="card-body table-responsive">

                <!-- ✅ SAME TABLE DESIGN -->
                <table id="myTable" class="table table-bordered table-hover align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>News Date</th>
                            <th>Show To</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
                    $q = mysqli_query($con,"SELECT * FROM news ORDER BY news_id DESC");

                    while($row = mysqli_fetch_assoc($q)){
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>

                            <td>
                                <button class="btn btn-sm btn-info"
                                    onclick="viewImage('upload/news/<?= $row['news_img'] ?>')">
                                    View
                                </button>
                            </td>

                            <td><?= htmlspecialchars($row['title']) ?></td>

                            <td>
                                <span class="badge <?= $row['status']=='active'?'bg-success':'bg-danger' ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </td>

                            <td><?= date("d-m-Y", strtotime($row['news_date'])) ?></td>

                            <td>
                                <span class="badge bg-info">
                                    <?= ucfirst($row['toshow_type']) ?>
                                </span>
                            </td>

                            <td>
                                <button class="btn btn-sm btn-success"
                                    onclick="editNews(<?= $row['news_id'] ?>)">
                                    Edit
                                </button>

                                <button class="btn btn-sm btn-danger"
                                    onclick="deleteNews(<?= $row['news_id'] ?>)">
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




<div class="modal fade" id="editNewsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5>Edit News</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="editNewsForm" enctype="multipart/form-data">
      <div class="modal-body">

        <input type="hidden" name="news_id" id="edit_news_id">

        <label for="">News Title</label>
        <input type="text" id="edit_title" name="title" class="form-control mb-2" placeholder="Title" required>

        <label for="">News description</label>
        <textarea id="newsText" name="description" class="form-control mb-2" required></textarea>
        <button type="button" onclick="hinglishToHindi()" class="btn btn-warning btn-sm">
    Hinglish → Hindi
</button>
<button type="button" onclick="autoTranslateHindi()" class="btn btn-warning btn-sm">
    Translate to Hindi
</button> 
<br><br>

      <label for="">Visible to</label>
        <select id="edit_toshow_type" name="toshow_type" class="form-control mb-2"  onchange="editTargetSelect()">
            <option value="all">All</option>
            <option value="zone">Zone</option>
            <option value="city">City</option>
            <option value="member">Member</option>
        </select>
         <!-- ZONE -->
          <div class="mb-3 d-none" id="zoneBox" >
            <label>Select Zone</label>
            <select class="form-select" name="toshow_id">
              <?php
              $z = mysqli_query($con,"SELECT * FROM zones ORDER BY zone_name ASC");
              while($row = mysqli_fetch_assoc($z)){ ?>
                <option value="<?= $row['zone_id'] ?>"><?= $row['zone_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <!-- CITY -->
          <div class="mb-3 d-none" id="cityBox" name="toshow_id">
            <label>Select City</label>
            <select class="form-select">
              <?php
              $c = mysqli_query($con,"SELECT * FROM cities ORDER BY city_name ASC");
              while($row = mysqli_fetch_assoc($c)){ ?>
                <option value="<?= $row['city_id'] ?>"><?= $row['city_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <!-- MEMBER -->
          <div class="mb-3 d-none" id="memberBox" name="toshow_id">
            <label>Select Member</label>
            <select class="form-select">
              <?php
              $m = mysqli_query($con,"SELECT member_id, fullname FROM members ORDER BY fullname ASC");
              while($row = mysqli_fetch_assoc($m)){ ?>
                <option value="<?= $row['member_id'] ?>"><?= $row['fullname'] ?></option>
              <?php } ?>
            </select>
          </div>

        <!-- <input type="text" id="edit_toshow_id" name="toshow_id" class="form-control mb-2" placeholder="Target ID"> -->
           <label for="">News Date</label>
        <input type="date" id="edit_news_date" name="news_date" class="form-control mb-2">

        <!-- <select id="edit_status" name="status" class="form-control mb-2">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select> -->

        <label for="">Status</label>
        <select id="edit_status" name="status" class="form-control mb-2">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <label for="">News Image</label>
        <input type="file" name="news_img" class="form-control">

        <img id="newsPreview" width="100" class="mt-2">

      </div>

      <div class="modal-footer">
        <button class="btn btn-success">Update</button>
      </div>
      </form>

    </div>
  </div>
</div>

</main>



<!-- ✅ DELETE NEWS AJAX -->
<script>
function deleteNews(id)
{
    if(confirm("Are you sure you want to delete this news?"))
    {
        $.ajax({
            url: "deleteNews.php",
            type: "POST",
            data: { id: id },
            success: function(response)
            {
                if(response == "success")
                {
                    alert("News Deleted Successfully");
                    location.reload();
                }
                else
                {
                    alert("Delete Failed");
                }
            }
        });
    }
}
</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
