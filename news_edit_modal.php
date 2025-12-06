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

        <input type="text" id="edit_title" name="title" class="form-control mb-2" placeholder="Title" required>

        <textarea id="newsText" name="description" class="form-control mb-2" required></textarea>
        <button type="button" onclick="hinglishToHindi()" class="btn btn-warning btn-sm">
    Hinglish → Hindi
</button>
<button type="button" onclick="autoTranslateHindi()" class="btn btn-warning btn-sm">
    Translate to Hindi
</button> 


        <select id="edit_toshow_type" name="toshow_type" class="form-control mb-2">
            <option value="all">All</option>
            <option value="zone">Zone</option>
            <option value="city">City</option>
            <option value="member">Member</option>
        </select>

        <!-- <input type="text" id="edit_toshow_id" name="toshow_id" class="form-control mb-2" placeholder="Target ID"> -->

        <input type="date" id="edit_news_date" name="news_date" class="form-control mb-2">

        <!-- <select id="edit_status" name="status" class="form-control mb-2">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select> -->

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
