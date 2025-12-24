<!-- footer.php -->
<footer class="footer-section text-white pt-5 pb-4"
style="background: linear-gradient(135deg, #ff914d, #ffca3a); position: relative; overflow: hidden;">

    <!-- Decorative Glow -->
    <div style="position:absolute; width:380px; height:380px; background:white; opacity:0.15; border-radius:50%; top:-120px; right:-100px; filter:blur(60px);"></div>
    <div style="position:absolute; width:300px; height:300px; background:white; opacity:0.12; border-radius:50%; bottom:-100px; left:-120px; filter:blur(70px);"></div>

    <div class="container">

        <div class="row text-center justify-content-center">

            <!-- BRAND -->
            <div class="col-md-12 mb-4 d-flex flex-column align-items-center" style="color:black;">

                <div class="d-flex align-items-center gap-3 mb-3">
                    <i class="bi bi-buildings-fill"
                       style="font-size:3.2rem;"></i>

                    <span class="fw-bold"
                          style="font-size:2.4rem; letter-spacing:1px;">
                        SocioManage
                    </span>
                </div>

                <p class="fw-semibold mb-1">
                    Smart Society Management System
                </p>

                <p class="small mb-0">
                    Connecting families, values & communities digitally
                </p>

            </div>

        </div>

        <hr class="border-light mt-4 mb-3">

        <!-- SOCIAL + COPYRIGHT -->
        <div class="text-center">
            <div class="d-flex justify-content-center gap-4 mb-2">
                <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
            </div>

            <p class="mb-0 small fw-bold">
                &copy; <?php echo date("Y"); ?> SocioManage. All Rights Reserved.
            </p>
        </div>

    </div>
</footer>






<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- JSZip (Excel Export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- PDFMake (PDF Export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script> -->

<script>

$(document).ready(function () {

    var table = $('#myTable').DataTable({
     
        dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
    });

   


});


$(document).ready(function () {

    var table = $('#myBTable').DataTable({
     
        dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
    });

    // ⭐ DATE FILTER
  $.fn.dataTable.ext.search.push(function (settings, data) {

    if (settings.nTable.id !== 'myBTable') return true;


    let start = $('#startDate').val();
    let end = $('#endDate').val();
    let billDate = data[1];  // Bill Date = column index 1

    let zone = $('#filterZone').val();
    let city = $('#filterCity').val();
    let type = $('#filterType').val(); // NEW BILL TYPE FILTER
    let crftype=$('#createBill').val();

    let rowCity = data[3];  // City column
    let rowZone = data[4];  // Zone column
    let rowType = data[6];  // Bill Type column
    let creatype= data[8];

    // ---- DATE FILTER ----
    if (start) start = new Date(start);
    if (end) end = new Date(end);
    if (billDate) billDate = new Date(billDate);

    if (start && billDate < start) return false;
    if (end && billDate > end) return false;

    // ---- ZONE FILTER ----
    if (zone && zone !== rowZone) return false;

    // ---- CITY FILTER ----
    if (city && city !== rowCity) return false;

    // ---- BILL TYPE FILTER ----
    if (type && type !== rowType) return false;

    if (crftype && crftype !== creatype) return false;


    return true;
});


 $('#startDate, #endDate, #filterZone, #filterCity, #filterType,#createBill').on('change', function () {
    table.draw();
});


});



$(document).ready(function () {

    let table = $('#myNewsTable').DataTable({
          dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
    });

    $.fn.dataTable.ext.search.push(function (settings, data) {
     
        if (settings.nTable.id !== 'myNewsTable') {
        return true;
    }

        let start = $('#startn').val();
        let end = $('#endn').val();

        let date = data[1];        // News Date
        let showTo = data[2];      // Show To
        let createdBy = data[3];   // Created By

        let zone = $('#zonen').val();
        let city = $('#cityn').val();
        let member = $('#membern').val();
        let created = $('#crn').val();

        // DATE FILTER
        if (start && new Date(date) < new Date(start)) return false;
        if (end && new Date(date) > new Date(end)) return false;

        // ZONE FILTER (IMPORTANT FIX)
        if (zone && showTo !==  zone) return false;

        // CITY FILTER (IMPORTANT FIX)
        if (city && showTo !==  city) return false;

        // MEMBER FILTER
        if (member && showTo !== "Member: " + member) return false;

        // CREATED BY FILTER
        if (created && createdBy !== created) return false;

        return true;
    });

    $('#startn, #endn, #zonen, #cityn, #membern, #crn')
        .on('change', function () {
            table.draw();
        });

});

$(document).ready(function () {

    // ✅ INIT DATATABLE
    let table = $('#myGalleryTable').DataTable({
         dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
    });

    // 🔥 CUSTOM FILTER LOGIC
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        if (settings.nTable.id !== 'myGalleryTable') return true;


        let fromDate   = $('#filter_from_date').val();
        let toDate     = $('#filter_to_date').val();
        let zone       = $('#filter_zone').val();
        let city       = $('#filter_city').val();
        let member     = $('#filter_member').val();
        let createdBy  = $('#filter_created_by').val();

        let tableDate  = data[1]; // Date column
        let showTo     = data[2]; // Zone / City / Member text
        let createdCol = data[3]; // Created By

        // 📅 DATE FILTER
        if (fromDate) {
            if (new Date(tableDate) < new Date(fromDate)) return false;
        }
        if (toDate) {
            if (new Date(tableDate) > new Date(toDate)) return false;
        }

        // 🗺️ ZONE FILTER
        if (zone && !showTo.includes(zone)) return false;

        // 🏙️ CITY FILTER
        if (city && !showTo.includes(city)) return false;

        // 👤 MEMBER FILTER
        if (member && !showTo.includes(member)) return false;

        // 🧑 CREATED BY FILTER
        if (createdBy && createdCol !== createdBy) return false;

        return true;
    });

    // 🔄 TRIGGER FILTER ON CHANGE
    $('#filter_from_date, #filter_to_date, #filter_zone, #filter_city, #filter_member, #filter_created_by')
        .on('change', function () {
            table.draw();
        });

});

$(document).ready(function(){

let table = $('#myMessageTable').DataTable({
     dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'],

         // ✅ HIGHLIGHT ROW
    // rowCallback: function(row, data) {

    //     let tSenderType = data[2]; // sender_type column

    //     if (tSenderType.toLowerCase() === 'admin') {
    //         $(row).addClass('table-danger'); // Bootstrap red
    //     }
    // }
});

$.fn.dataTable.ext.search.push(function(settings, data){
    if (settings.nTable.id !== 'myMessageTable') return true;


    let fromDate = $('#filter_from_date').val();
    let toDate   = $('#filter_to_date').val();
    let senderType = $('#filter_sender_type').val();
    let sender  = $('#filter_sender').val();
    let receiver = $('#filter_receiver').val();
    let createdBy = $('#filter_created_by').val();
    let receiverType=$('#filter_receiver_type').val();

    let tableDate = data[1];
    let tSenderType = data[2];
    let tSender = data[3];
    let tReceiverType = data[4];
    let tReceiver = data[5];
    let tCreatedBy = data[7];

    if(fromDate && new Date(tableDate) < new Date(fromDate)) return false;
    if(toDate && new Date(tableDate) > new Date(toDate)) return false;

    if(senderType && tSenderType !== senderType) return false;
    if(sender && !tSender.includes(sender)) return false;
        if(receiverType && tReceiverType !== receiverType) return false;

    if(receiver && !tReceiver.includes(receiver)) return false;
    if(createdBy && !tCreatedBy.includes(createdBy)) return false;

    return true;
});

$('#filter_from_date,#filter_to_date,#filter_sender_type,#filter_sender,#filter_receiver_type,#filter_receiver,#filter_created_by')
.on('change keyup', function(){
    table.draw();
});

});

$(document).ready(function(){

let table = $('#myDownloadTable').DataTable({
     dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']

        
});

$.fn.dataTable.ext.search.push(function(settings, data){
    if (settings.nTable.id !== 'myDownloadTable') return true;


    let fromDate = $('#filter_from_date').val();
    let toDate   = $('#filter_to_date').val();
    let downshow = $('#filter_downshow').val();
    let createdBy = $('#filter_create_by').val();

    let tableDate = data[2]; // Created At
    let tDownshow = data[3]; // Downshow
    let tCreatedBy = data[4];

    if(fromDate && new Date(tableDate) < new Date(fromDate)) return false;
    if(toDate && new Date(tableDate) > new Date(toDate)) return false;

    if(downshow && !tDownshow.toLowerCase().includes(downshow)) return false;
    if(createdBy && !tCreatedBy.includes(createdBy)) return false;

    return true;
});

$('#filter_from_date,#filter_to_date,#filter_downshow,#filter_create_by')
.on('change keyup', function(){
    table.draw();
});

});


$(document).ready(function(){

let table = $('#myReqTable').DataTable({
    dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
});
$.fn.dataTable.ext.search.push(function(settings, data){
    if (settings.nTable.id !== 'myReqTable') return true;


    let rf = $('#reqs').val();
    let rt = $('#reqt').val();
    let af = $('#apps').val();
    let at = $('#appt').val();
    let zone = $('#zoer').val();
    let city = $('#cityr').val();
    let plan = $('#planr').val();
    let stat = $('#statusr').val();

    let reqDate = data[5];
    let appDate = data[6];

    if(rf && new Date(reqDate) < new Date(rf)) return false;
    if(rt && new Date(reqDate) > new Date(rt)) return false;

    if(af && appDate !== '-' && new Date(appDate) < new Date(af)) return false;
    if(at && appDate !== '-' && new Date(appDate) > new Date(at)) return false;

    if(zone && data[2] !== zone) return false;
    if(city && data[3] !== city) return false;
    if(plan && data[4] !== plan) return false;

    // ✅ STATUS FIX
    let statusText = data[7].replace(/<[^>]*>/g,'').trim().toLowerCase();
    if(stat && statusText !== stat.toLowerCase()) return false;

    return true;
});


$('#reqs,#reqt,#apps,#appt,#zoer,#cityr,#planr,#statusr')
.on('change', function(){
    table.draw();
});

});

$(document).ready(function(){

let table = $('#myEventTable').DataTable({
    pageLength:10,
    dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
});

$.fn.dataTable.ext.search.push(function(settings,data){

    if(settings.nTable.id!=='myEventTable') return true;

    let start=$('#ev_start').val();
    let end=$('#ev_end').val();
    let zone=$('#ev_zone').val();
    let city=$('#ev_city').val();
    let member=$('#ev_member').val();
    let created=$('#ev_created').val();

    let date=data[1];
    let showTo=data[3];
    let createdBy=data[4];

    if(start && new Date(date)<new Date(start)) return false;
    if(end && new Date(date)>new Date(end)) return false;

    if(zone && showTo!==zone) return false;
    if(city && showTo!==city) return false;
    if(member && showTo!=="Member: "+member) return false;
    if(created && createdBy!==created) return false;

    return true;
});

$('#ev_start,#ev_end,#ev_zone,#ev_city,#ev_member,#ev_created')
.on('change',function(){
    table.draw();
});

});



$(document).ready(function(){

    let table = $('#expenseTable').DataTable();

    // Show/hide custom input for "Other"
    $('#filter_expense_type').on('change', function(){
        if(this.value === 'Other'){
            $('#filter_expense_other').show().val('');
        } else {
            $('#filter_expense_other').hide();
            table.column(1).search(this.value).draw();
        }
    });

    // Custom text input filter
    $('#filter_expense_other').on('keyup change', function(){
        table.column(1).search(this.value).draw();
    });

    // Created By Filter
    $('#filter_created_by').on('change', function(){
        table.column(5).search(this.value).draw();
    });

    // Date Range Filter
    $.fn.dataTable.ext.search.push(function(settings, data){
        if (settings.nTable.id !== 'expenseTable') return true;

        let from = $('#filter_from_date').val();
        let to   = $('#filter_to_date').val();
        let date = data[3]; // expense_date column

        if(from) from = new Date(from);
        if(to)   to   = new Date(to);

        let rowDate = new Date(date);

        if(
            (!from && !to) ||
            (!from && rowDate <= to) ||
            (from && !to && rowDate >= from) ||
            (rowDate >= from && rowDate <= to)
        ){
            return true;
        }
        return false;
    });

    $('#filter_from_date, #filter_to_date').on('change', function(){
        table.draw();
    });

});


$(document).ready(function(){

    let table = $('#myDisplayTable').DataTable({
        pageLength: 10,
        lengthMenu: [10,25,50,100]
    });

    // Load cities on zone change
    $("#flterzone").on("change", function(){

        let zoneID = $(this).val();
        $("#fltercity").html('<option value="">All Cities</option>');

        $.ajax({
            url: "getCity.php",
            type: "GET",
            data: { zone_id: zoneID },
            success: function(data){
                $("#fltercity").append(data);
            }
        });

        table.draw(); // filter table also

    });

    // filter table on city change
    $("#fltercity").on("change", function(){
        table.draw();
    });

    // CUSTOM FILTER for zone + city
   $.fn.dataTable.ext.search.push(function(settings, data){

            if (settings.nTable.id !== 'myDisplayTable') return true;


    let selectedZone = $("#flterzone").val();
    let selectedCity = $("#fltercity").val();

    let rowZoneID = data[6]; // zone id column
    let rowCityID = data[7]; // city id col

    if(selectedZone && selectedZone != rowZoneID){
        return false;
    }

    if(selectedCity && selectedCity != rowCityID){
        return false;
    }

    return true;
});



});
$(document).ready(function(){

    let serviceTable = $('#serviceTable').DataTable({
        pageLength: 10,
        lengthMenu: [10,25,50,100]
    });

    // Load city dropdown onchange zone
    $("#filterZone").on("change", function(){

        let zoneID = $(this).val();
        $("#filterCity").html('<option value="">All Cities</option>');

        $.ajax({
            url: "getCity.php",
            type: "GET",
            data: { zone_id: zoneID },
            success: function(data){
                $("#filterCity").append(data);
            }
        });

        serviceTable.draw();
    });

    // City filter change
    $("#filterCity").on("change", function(){
        serviceTable.draw();
    });

    // Service type filter change
    $("#filterService").on("change", function(){

        // Show/hide custom input for "Other"
        if($(this).val() == "Other"){
            $("#customService").show();
        } else {
            $("#customService").hide();
            $("#customService").val("");
        }

        serviceTable.draw();
    });

    // Custom Service text input filter
    $("#customService").on("keyup", function(){
        serviceTable.draw();
    });

    // Custom filter for DataTable
    $.fn.dataTable.ext.search.push(function(settings, data){

        if (settings.nTable.id !== 'serviceTable') return true;

        let selectedZone = $("#filterZone").val();
        let selectedCity = $("#filterCity").val();
        let selectedService = $("#filterService").val();
        let customService = $("#customService").val().trim().toLowerCase();

        let rowZoneID = data[8];   // hidden zone_id
        let rowCityID = data[9];   // hidden city_id
        let rowServType = data[2].toLowerCase();  // service type column

        // Zone filter
        if(selectedZone && selectedZone != rowZoneID){
            return false;
        }

        // City filter
        if(selectedCity && selectedCity != rowCityID){
            return false;
        }

        // Service Type filter
        if(selectedService && selectedService != "Other" && selectedService.toLowerCase() != rowServType){
            return false;
        }

        // Custom service filter for "Other"
        if(selectedService == "Other" && customService && !rowServType.includes(customService)){
            return false;
        }

        return true;
    });

});

$(document).ready(function(){

    let table = $('#familyTable').DataTable({
        pageLength:10,
    dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
            "<'row'<'col-sm-12'B>>",

        bLengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print']
    });

    $('#zoneFilter, #cityFilter, #maritalFilter').on('change', function(){
        table.draw();
    });

    $.fn.dataTable.ext.search.push(function(settings, data){

         if (settings.nTable.id !== 'familyTable') return true;

        let zone    = $('#zoneFilter').val();
        let city    = $('#cityFilter').val();
        let marital = $('#maritalFilter').val();

        let rowZone    = data[8].trim();
        let rowCity    = data[9].trim();
        let rowMarital = data[5].trim();

        if(zone && rowZone !== zone) return false;
        if(city && rowCity !== city) return false;
        if(marital && rowMarital !== marital) return false;

        return true;
    });

});

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./script.js"></script>

</body>
</html>