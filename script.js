$(document).ready(function(){

    // STATE AJAX
    $("#stateFormAjax").submit(function(e){
        e.preventDefault(); // Prevent page reload
        $.ajax({
            url: "states_save.php",
            method: "POST",
            data: $(this).serialize(),
            success: function(resp){
                $("#stateMessage").html(resp);
                $("#stateFormAjax")[0].reset();
                loadAllStateDropdowns(); // optional, to refresh dropdowns
            },
            error: function(err){
                $("#stateMessage").html("Error: "+err.statusText);
            }
        });
    });

    // ZONE AJAX
    $("#zoneFormAjax").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "zones_save.php",
            method: "POST",
            data: $(this).serialize(),
            success: function(resp){
                $("#zoneMessage").html(resp);
                $("#zoneFormAjax")[0].reset();
            }
        });
    });

    // CITY AJAX
    $("#cityFormAjax").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "cities_save.php",
            method: "POST",
            data: $(this).serialize(),
            success: function(resp){
                $("#cityMessage").html(resp);
                $("#cityFormAjax")[0].reset();
                $("#zoneDropdown").html("<option value=''>Select Zone</option>");
            }
        });
    });

});

// LOAD ZONES when state changes
function loadZones(){
    let sid = $("#stateDropdown").val();
    if(sid == "") {
        $("#zoneDropdown").html("<option value=''>Select Zone</option>");
        return;
    }

    $.ajax({
        url: "getZones.php",
        method: "GET",
        data: { state_id: sid },
        success: function(data){
            $("#zoneDropdown").html(data);
        }
    });
}


function goStep(step, direction) {

    // ✅ CURRENT STEP DETECT
    let currentStep = document.querySelector(".step-box:not([style*='display: none'])");

    // ✅ REQUIRED FIELD CHECK
    let requiredFields = currentStep.querySelectorAll("input[required], select[required], textarea[required]");
    let valid = true;

    requiredFields.forEach(function(field){

        // ✅ Radio validation
        if(field.type === "radio"){
            let group = currentStep.querySelectorAll("input[name='"+field.name+"']");
            let checked = false;

            group.forEach(r => { if (r.checked) checked = true; });

            if(!checked){
                valid = false;
            }

        }
        // ✅ Normal input validation
        else{
            if(field.value.trim() === ""){
                valid = false;
                field.classList.add("is-invalid");
            } else {
                field.classList.remove("is-invalid");
            }
        }
    });

    // ❌ STOP IF INVALID
    if (!valid) {
        alert("⚠️ Please fill all required fields first!");
        return;
    }

    // ✅ HIDE ALL STEPS
    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").style.display = "none";
    document.getElementById("step4").style.display = "none";

    // ✅ REMOVE ACTIVE INDICATORS
    document.getElementById("step1Btn").classList.remove("active-step");
    document.getElementById("step2Btn").classList.remove("active-step");
    document.getElementById("step3Btn").classList.remove("active-step");
    document.getElementById("step4Btn").classList.remove("active-step");

    // ✅ SHOW NEW STEP
    let box = document.getElementById("step" + step);
    box.style.display = "block";

    if (direction === "left") box.classList.add("show-left");
    if (direction === "right") box.classList.add("show-right");

    // ✅ ACTIVATE INDICATOR
    document.getElementById("step" + step + "Btn").classList.add("active-step");
}

function loadZones() {
    var sid = document.getElementById("stateDropdown").value;

    fetch("getZones.php?state_id=" + sid)
        .then(res => res.text())
        .then(data => { document.getElementById("zoneDropdown").innerHTML = data; });
}

function loadCities() {
    var zid = document.getElementById("zoneDropdown").value;

    fetch("getCity.php?zone_id=" + zid)
        .then(res => res.text())
        .then(data => { document.getElementById("cityDropdown").innerHTML = data; });
}

function selectGender(el) {
    document.querySelectorAll(".gender-card").forEach(card => {
        card.classList.remove("selected");
    });
    el.classList.add("selected");
    el.querySelector("input").checked = true;
}

function previewImage(event){
    let img = document.getElementById("previewImg");
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = "block";
}

$("#eventForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "event_save.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            $("#eventMsg").html(res);
            $("#eventForm")[0].reset();
        }
    });
});



// AJAX Save
$("#newsForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "news_save.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            $("#newsMsg").html(res);
            $("#newsForm")[0].reset();
            $("#previewNewsImg").attr("src", "");
        }
    });
});

// $(document).ready(function(){
//     let currentRequestId = 0;

//     $(".viewProfileBtn").click(function(){
//         let memberId = $(this).data("member");
//         currentRequestId = $(this).data("request");

//         $.ajax({
//             url: "get_member_details.php",
//             type: "GET",
//             data: { member_id: memberId },
//             success: function(res){
//                 $("#memberDetails").html(res);
//                 new bootstrap.Modal(document.getElementById('memberModal')).show();
//             }
//         });
//     });

//     $("#approveBtn").click(function(){
//         $.ajax({
//             url: "update_request_status.php",
//             type: "POST",
//             data: { request_id: currentRequestId, status: "approved" },
//             success: function(res){
//                 $("#memberModal").modal('hide');
//                 $("#pendingList").load(" #pendingList > *");
//             }
//         });
//     });

//     $("#rejectBtn").click(function(){
//         $.ajax({
//             url: "update_request_status.php",
//             type: "POST",
//             data: { request_id: currentRequestId, status: "rejected" },
//             success: function(res){
//                 $("#memberModal").modal('hide');
//                 $("#pendingList").load(" #pendingList > *");
//             }
//         });
//     });
// });

// ---------- ZONE EDIT ----------
function editZone(id, name){
    $("#editZoneId").val(id);
    $("#editZoneName").val(name);
    $("#zoneModal").modal("show");
}

// ---------- ZONE UPDATE ----------
function updateZone(){
    let id = $("#editZoneId").val();
    let name = $("#editZoneName").val();

    $.post("zone_update.php", {
        id: id,
        name: name
    }, function(response){

        if(response.trim() == "success"){
            // Update name directly in table
            $("#zoneRow"+id+" td:nth-child(2)").text(name);

            $("#zoneModal").modal("hide");

            $("#zoneMessage").html(`
                <div class="alert alert-success animate__animated animate__fadeIn">
                    Zone updated successfully!
                </div>
            `);
        } else {
            $("#zoneMessage").html(`
                <div class="alert alert-danger">Update Failed</div>
            `);
        }

    });
}

// ---------- ZONE DELETE ----------
function deleteZone(id){

    if(!confirm("Are you sure to delete this zone?")) return;

    $.ajax({
        url: "zone_delete.php",
        type: "POST",
        data: { id: id },
        success: function(res){

            if(res.trim() == "active"){
                alert("❌ Active zone cannot be deleted!");
            }
            else if(res.trim() == "success"){
                alert("✅ Zone deleted successfully");
                $("#zoneRow"+id).fadeOut();
            }
            else{
                alert("❌ Delete failed!");
            }
        }
    });
}

// ---------- CITY EDIT ----------
function editCity(id, name){
    $("#editCityId").val(id);
    $("#editCityName").val(name);
    $("#cityModal").modal("show");
}

// ---------- CITY UPDATE ----------
function updateCity(){
    let id = $("#editCityId").val();
    let name = $("#editCityName").val();

    $.post("city_update.php", {
        id: id,
        name: name
    }, function(response){

        if(response.trim() == "success"){
            // Update city name directly in table
            $("#cityRow"+id+" td:nth-child(2)").text(name);

            $("#cityModal").modal("hide");

            $("#cityMessage").html(`
                <div class="alert alert-success animate__animated animate__fadeIn">
                    City updated successfully!
                </div>
            `);
        }else{
            $("#cityMessage").html(`
                <div class="alert alert-danger">Update Failed</div>
            `);
        }

    });
}

// ---------- CITY DELETE ----------
// ---------- ZONE DELETE ----------
function deleteCity(id){

    if(!confirm("Are you sure to delete this city?")) return;

    $.ajax({
        url: "city_delete.php",
        type: "POST",
        data: { id: id },
        success: function(res){

            if(res.trim() == "active"){
                alert("❌ Active city cannot be deleted!");
            }
            else if(res.trim() == "success"){
                alert("✅ city deleted successfully");
                $("#zoneRow"+id).fadeOut();
            }
            else{
                alert("❌ Delete failed!");
            }
        }
    });
}

// document.addEventListener("DOMContentLoaded", function(){

//     // CITY TAB CLICK
//     document.getElementById("editC-tab").addEventListener("click", function(){
//         document.getElementById("locationListSection").classList.remove("d-none");
//     });

//     // ZONE TAB CLICK (if you have a zone tab button)
//     let zoneTab = document.getElementById("editZ-tab");
//     if(zoneTab){
//         zoneTab.addEventListener("click", function(){
//             document.getElementById("locationListSection").classList.remove("d-none");
//         });
//     }

// });
// document.getElementById("state-tab").addEventListener("click", function(){
//     document.getElementById("locationListSection").classList.add("d-none");
// });

document.addEventListener("DOMContentLoaded", function(){

    const zoneList  = document.getElementById("zoneListSection");
    const cityList  = document.getElementById("cityListSection");

    const addZoneBtn = document.getElementById("zone-tab");
    const addCityBtn = document.getElementById("city-tab");
    const editZoneBtn = document.getElementById("editZ-tab");
        const searchZoneBtn = document.getElementById("searchZoneBtn");
                const searchCityBtn = document.getElementById("searchCityBtn");


    const editCityBtn = document.getElementById("editC-tab");

    // Hide all lists by default
    function hideAllLists(){
        zoneList.classList.add("d-none");
        cityList.classList.add("d-none");
        searchZoneBtn.classList.add("d-none");
                searchCityBtn.classList.add("d-none");


        
    }

    // ✅ ADD ZONE → HIDE ALL LISTS
    addZoneBtn.addEventListener("click", function(){
        hideAllLists();
    });

    // ✅ ADD CITY → HIDE ALL LISTS
    addCityBtn.addEventListener("click", function(){
        hideAllLists();
    });

    // ✅ EDIT ZONE → SHOW ONLY ZONE LIST
    editZoneBtn.addEventListener("click", function(){
        hideAllLists();
        zoneList.classList.remove("d-none");
                        searchZoneBtn.classList.remove("d-none");

    });

    // ✅ EDIT CITY → SHOW ONLY CITY LIST
    editCityBtn.addEventListener("click", function(){
        hideAllLists();
        cityList.classList.remove("d-none");
                        searchCityBtn.classList.remove("d-none");

    });

});

function toggleTargetSelect(){
    let type = document.getElementById("toshow_type").value;

    document.getElementById("zoneBox").classList.add("d-none");
    document.getElementById("cityBox").classList.add("d-none");
    document.getElementById("memberBox").classList.add("d-none");

    if(type === "zone"){
        document.getElementById("zoneBox").classList.remove("d-none");
    }
    else if(type === "city"){
        document.getElementById("cityBox").classList.remove("d-none");
    }
    else if(type === "member"){
        document.getElementById("memberBox").classList.remove("d-none");
    }
}

$("#visibilityType").change(function(){
    let v = $(this).val();
    $("#zoneBox, #cityBox, #memberBox").addClass("d-none");

    if(v=="zone") $("#zoneBox").removeClass("d-none");
    if(v=="city") $("#cityBox").removeClass("d-none");
    if(v=="member") $("#memberBox").removeClass("d-none");
});

function previewGallery(event){
    let img = document.getElementById("galleryPreview");
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display="block";
}

$("#galleryForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "gallery_save.php",
        type: "POST",
        data: formData,
        contentType:false,
        processData:false,
        success:function(res){
            $("#galleryMsg").html(res);
            $("#galleryForm")[0].reset();
            $("#galleryPreview").hide();
        }
    });
});

$("#searchUser").on("keyup", function(){
    let name = $(this).val();

    if(name.length > 0){
        $.ajax({
            url: "search_user.php",
            type: "POST",
            data: { name: name },
            success: function(data){
                $("#searchResult").html(data);
            }
        });
    } else {
        $("#searchResult").html("");
    }
});

function deleteUser(id){
    if(confirm("Are you sure you want to delete this user?")){
        $.post("delete_user.php", {id:id}, function(data){
            alert(data);
            $("#searchUser").keyup(); // refresh list
        });
    }
}



function editUser(id){
    $.post("fetch_edit_user.php",{id:id},function(data){

        let user = JSON.parse(data);

        $("#edit_user_id").val(user.user_id);
        $("#edit_fullname").val(user.fullname);
        $("#edit_email").val(user.email);
        $("#edit_uname").val(user.uname);
        $("#edit_dob").val(user.dob);
        $("#edit_gender").val(user.gender);
        $("#edit_address").val(user.address);

        

        $("#edit_zone").html(user.zoneOptions);
        $("#edit_city").html(user.cityOptions);

        let modal = new bootstrap.Modal(document.getElementById('editUserModal'));
        modal.show();
    });
}

function loadCitiesByZone(zoneId){
    $.post("get_cities_by_zone.php",{zone_id:zoneId},function(data){
        $("#edit_city").html(data);
    });
}



function updateUser(){
    $.post("update_user.php",{
        user_id: $("#edit_user_id").val(),
        fullname: $("#edit_fullname").val(),
        email: $("#edit_email").val(),
        uname: $("#edit_uname").val(),
        dob: $("#edit_dob").val(),
        gender: $("#edit_gender").val(),
        zone: $("#edit_zone").val(),
        city: $("#edit_city").val(),
        address: $("#edit_address").val()
    },function(res){
        $("#updateMsg").html(res);
        setTimeout(()=>location.reload(),1200);
    });
}

$("#editUserForm").submit(function(e){
    e.preventDefault();

    $.post("update_user.php", $(this).serialize(), function(resp){
        if(resp=="success"){
            $("#editMsg").html("<div class='alert alert-success'>✅ Profile Updated</div>");
            setTimeout(()=>{
                $("#editUserModal").modal("hide");
                location.reload();
            },1200);
        }else{
            $("#editMsg").html("<div class='alert alert-danger'>❌ Update Failed</div>");
        }
    });
});






function deleteEvent(event_id)
{
    if(!event_id){
        alert("Invalid Event ID");
        return;
    }

    if(confirm("Are you sure you want to delete this event?"))
    {
        $.ajax({
            url: "deleteEvent.php",
            type: "POST",
            data: { event_id: event_id },
            success: function(response)
            {
                console.log(response);   // ✅ DEBUG LINE

                if(response.trim() === "success")
                {
                    alert("Event Deleted Successfully");
                    location.reload();
                }
                else
                {
                    alert("Delete Failed: " + response);
                }
            },
            error: function(){
                alert("AJAX Error");
            }
        });
    }
}

function editTargetSelect(){
    let type = document.getElementById("edit_toshow_type").value;

    document.getElementById("zoneBox").classList.add("d-none");
    document.getElementById("cityBox").classList.add("d-none");
    document.getElementById("memberBox").classList.add("d-none");

    if(type === "zone"){
        document.getElementById("zoneBox").classList.remove("d-none");
    }
    else if(type === "city"){
        document.getElementById("cityBox").classList.remove("d-none");
    }
    else if(type === "member"){
        document.getElementById("memberBox").classList.remove("d-none");
    }
}

function editNews(id){
    $.post("get_news.php",{id:id},function(data){
        let n = JSON.parse(data);

        $("#edit_news_id").val(n.news_id);
        $("#edit_title").val(n.title);
        $("#edit_description").val(n.description);
        $("#edit_toshow_type").val(n.toshow_type);
        $("#edit_toshow_id").val(n.toshow_id);
        $("#edit_news_date").val(n.news_date);
        $("#edit_status").val(n.status);

        $("#newsPreview").attr("src","upload/news/"+n.news_img);

        $("#editNewsModal").modal("show");
    });
}

$("#editNewsForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url:"update_news.php",
        method:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(res){
            alert("news has been updated");
            location.reload();
        }
    });
});
$(document).ready(function(){

    loadUsers(); // ✅ Page load pe sab users auto load honge

    $("#searchUser").keyup(function(){
        loadUsers();
    });

    $("#filter_zone").change(function(){
        let zid = $(this).val();

        $.post("get_cities.php",{zone_id:zid},function(data){
            $("#filter_city").html(data);
        });
    });

    $("#filter_city, #sort_alpha").change(function(){
        loadUsers();
    });

});

// ✅ MAIN FUNCTION
function loadUsers(){
    let search = $("#searchUser").val();
    let zone   = $("#filter_zone").val();
    let city   = $("#filter_city").val();
    let alpha  = $("#sort_alpha").val();

    $.post("ajax_fetch_users.php",{
        search:search,
        zone:zone,
        city:city,
        alpha:alpha
    },function(data){
        $("#searchResult").html(data);
    });
}

// function translateNews(){
//     let originalText = $("#news_description").val();
//     let targetLang   = $("#targetLang").val();

//     if(originalText.trim() == ""){
//         alert("Pehle description likho!");
//         return;
//     }

//     $.ajax({
//         url: "https://libretranslate.de/translate",
//         type: "POST",
//         data: {
//             q: originalText,
//             source: "auto",
//             target: targetLang,
//             format: "text"
//         },
//         success: function(res){
//             // ✅ Output kisi aur box me chahiye:
//             $("#translated_description").val(res.translatedText);

//             // ✅ Agar chaho toh SAME textarea me bhi daal sakte ho:
//             // $("#news_description").val(res.translatedText);
//         },
//         error:function(){
//             alert("Translation server error!");
//         }
//     });
// }
// function translateTextarea(){
//     let text = $("#news_description").val();
//     let lang = $("#targetLang").val();

//     if(text.trim() == ""){
//         alert("Pehle kuch likho textarea me!");
//         return;
//     }

//     $.ajax({
//         url: "translate.php",
//         type: "POST",
//         data: {
//             text: text,
//             lang: lang
//         },
//         success: function(response){
//             $("#news_description").val(response); // ✅ AUTO REPLACE
//         }
//     });
// }
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'hi,en,gu,ta,te,ur',
    autoDisplay: false
  }, 'google_translate_element');
}
function autoTranslateHindi() {
    var text = document.getElementById("newsText").value;

    if(text.trim() == ""){
        alert("Please enter text first");
        return;
    }

    var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=hi&dt=t&q=" + encodeURIComponent(text);

    fetch(url)
    .then(response => response.json())
    .then(data => {
        document.getElementById("newsText").value = data[0][0][0];
    })
    .catch(() => {
        alert("Translation failed");
    });
}

function hinglishToHindi(){
    var text = document.getElementById("newsText").value.trim();

    if(text == ""){
        alert("Please enter text first");
        return;
    }

    var url = "https://inputtools.google.com/request?text=" 
              + encodeURIComponent(text) + "&itc=hi-t-i0-und&num=1";

    fetch(url)
    .then(res => res.json())
    .then(data => {
        if(data[0] == "SUCCESS"){
            document.getElementById("newsText").value = data[1][0][1][0];
        }else{
            alert("Transliteration failed");
        }
    })
    .catch(() => alert("Server Error"));
}

function filterZones(){
    let search = $("#searchZone").val();
    let sort   = $("#sortZone").val();

    $.post("ajax_fetch_zones.php",{
        search:search,
        sort:sort
    },function(data){
        $("#zoneList").html(data);
    });
}

// ✅ Page Load par auto load
$(document).ready(function(){
    filterZones();
});

function filterCities(){
    let search = $("#searchCity").val();
    let zone   = $("#filterZone").val();
    let sort   = $("#sortCity").val();

    $.post("ajax_fetch_cities.php",{
        search:search,
        zone:zone,
        sort:sort
    },function(data){
        $("#cityList").html(data);
    });
}

// ✅ Auto Load
$(document).ready(function(){
    filterCities();
});

$(document).ready(function(){
  let table = new DataTable('#myTable',{
     searching:true,
     paging:true,
     sort:true

  });
       


  });

  function deactivateZone(zid){

    if(!confirm("Are you sure you want to deactivate this zone?")){
        return;
    }

    $.ajax({
        url: "deactivate_zone.php",
        type: "POST",
        data: { zone_id: zid },
        success: function(res){
            alert(res);

            // ✅ Row hide after success
            $("#zoneRow" + zid).fadeOut();
        }
    });
}
function activateZone(zid){

    if(!confirm("Are you sure you want to activate this zone?")){
        return;
    }

    $.ajax({
        url: "activate_zone.php",
        type: "POST",
        data: { zone_id: zid },
        success: function(res){
            alert(res);

            // ✅ Row hide after success
            $("#zoneRow" + zid).fadeOut();
        }
    });
}

function deactivateCity(zid){

    if(!confirm("Are you sure you want to deactivate this city?")){
        return;
    }

    $.ajax({
        url: "deactivateCity.php",
        type: "POST",
        data: { zone_id: zid },
        success: function(res){
            alert(res);

            // ✅ Row hide after success
            $("#zoneRow" + zid).fadeOut();
        }
    });
}
function activateCity(zid){

    if(!confirm("Are you sure you want to activate this city?")){
        return;
    }

    $.ajax({
        url: "activateCity.php",
        type: "POST",
        data: { zone_id: zid },
        success: function(res){
            alert(res);

            // ✅ Row hide after success
            $("#zoneRow" + zid).fadeOut();
        }
    });
}

function viewImage(imgPath)
{
    document.getElementById("fullImagePreview").src = imgPath;
    var modal = new bootstrap.Modal(document.getElementById('imageViewModal'));
    modal.show();
}

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