<!-- footer.php -->
<footer class="footer-section text-white pt-5 pb-4" 
style="background: linear-gradient(135deg, #ff914d, #ffca3a); position: relative; overflow: hidden;">

    <!-- Decorative Glow -->
    <div style="position:absolute; width:380px; height:380px; background:white; opacity:0.15; border-radius:50%; top:-120px; right:-100px; filter:blur(60px);"></div>
    <div style="position:absolute; width:300px; height:300px; background:white; opacity:0.12; border-radius:50%; bottom:-100px; left:-120px; filter:blur(70px);"></div>

    <div class="container">

        <div class="row text-center text-md-start align-items-start justify-content-between">

            <!-- LOGO + REGISTRATION -->
            <div class="col-md-4 mb-4 d-flex flex-column align-items-center" style="color:black;">
                <img src="upload/logo2.png" 
                     alt="Jain Society Logo" 
                     style="width:370px; margin-bottom:15px; ">

                <p class="fw-bold mb-1">पंजीकृत कार्यालय: छिंदवाड़ा (म.प्र.)</p>
                <p class="fw-bold">पंजीकृत क्रमांक: 173/53/54</p>
            </div>

            <!-- ADDRESS + MAP (CENTER FIXED) -->
            <div class="col-md-4 mb-4 d-flex flex-column align-items-center" style="color:black;">

                <h5 class="fw-bold mb-3 text-center">📍 Address</h5>

                <p class="mb-1" style="letter-spacing:0;"> कार्यालय : इतवारी, भाजीमंडी, फूलओली</p>
                <p class="mb-1">नागपुर - 440002</p>

                <p class="mb-1">Email: digambarjainnagpurprantiya@gmail.com</p>
                <ul style="list-style:none; padding-left:0;">
                    <li>📞 +91 9981511572</li>
                    <li>📞 +91 9425235045</li>
                    <li>📞 +91 9425506778</li>
               
                </ul>

                <!-- ⭐ CENTER ALIGNED MAP -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14883.891597777874!2d79.0928077697754!3d21.153476764494485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c74996f64add%3A0x263559eb5ec4de5e!2sKhandelwal%20bhawan%20(%20nagpur%20pratheeya%20digamber%20jain%20khandelwal%20sabha!5e0!3m2!1sen!2sin!4v1765268468005!5m2!1sen!2sin" 
                    width="100%" height="220"
                    style="border:0; border-radius:12px;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>

            <!-- DONATION (CENTER FIXED) -->
            <div class="col-md-4 mb-4 d-flex flex-column align-items-center">

                <h5 class="fw-bold mb-3 text-center" style="color:black;">🙏 Donation Details</h5>

                <div class="p-3 shadow-sm rounded-4 mb-2"
                     style="background: rgba(255,255,255,0.20); backdrop-filter: blur(6px); width:100%; max-width:300px; color:black;">
                    <b>Bank:</b>  Central Bank of India <br>
                    <b>A/C No:</b> 1136216044 <br>
                    <b>IFSC:</b> CBIN0282102 <br>
                    <b>Branch:</b> Maskasath Nagpur Branch
                </div>

                <div class="p-3 shadow-sm rounded-4 text-center"
                     style="background: rgba(255,255,255,0.20); backdrop-filter: blur(6px); width:100%; max-width:300px; color:black;">
                    <b>UPI ID:</b> 10951209@cbin <br>
                    <img src="upload/qrcode.png" 
                         alt="Donate QR"
                         style="width:110px; margin-top:10px; border-radius:12px;">
                </div>
            </div>

        </div>

        <hr class="border-light mt-4 mb-3">

        <!-- SOCIAL + COPYRIGHT -->
        <div class="text-center">
            <div class="d-flex justify-content-center gap-3 mb-2">
                <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
            </div>

            <p class="mb-0 small fw-bold">&copy; 2025 All Rights Reserved.</p>
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

    // ⭐ DATE FILTER
  $.fn.dataTable.ext.search.push(function (settings, data) {

    let start = $('#startDate').val();
    let end = $('#endDate').val();
    let billDate = data[1];  // Bill Date = column index 1

    let zone = $('#filterZone').val();
    let city = $('#filterCity').val();
    let type = $('#filterType').val(); // NEW BILL TYPE FILTER

    let rowCity = data[3];  // City column
    let rowZone = data[4];  // Zone column
    let rowType = data[6];  // Bill Type column

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

    return true;
});


 $('#startDate, #endDate, #filterZone, #filterCity, #filterType').on('change', function () {
    table.draw();
});


});

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./script.js"></script>

</body>
</html>