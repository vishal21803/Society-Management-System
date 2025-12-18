<?php
include("connectdb.php");


if(!isset($_GET['receipt_id'])){
    die("Invalid Receipt");
}

$receipt_id = $_GET['receipt_id'];

/* ✅ RECEIPT + MEMBER + CITY JOIN */
$q = mysqli_query($con,"
SELECT 
    r.*,
    m.fullname,
    m.city_id,
    c.city_name
FROM sens_receipt r
JOIN sens_members m ON r.member_id = m.member_id
LEFT JOIN sens_cities c ON m.city_id = c.city_id
WHERE r.receipt_id = '$receipt_id'
");

$receipt = mysqli_fetch_assoc($q);

if(!$receipt){
    die("Receipt Not Found");
}

$amount  = $receipt['receipt_amount'];
$purpose = $receipt['receipt_type'];
$date    = date("d-m-Y", strtotime($receipt['recdate']));
$member  = $receipt['fullname'];
$city    = $receipt['city_name'];
$manID= $receipt['manualID'];
$desc=$receipt['purpose'];

/* ✅ Amount in Words */
function amountInWords($number){
    $formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return ucfirst($formatter->format($number)) . " only";
}

/* ✅ Purpose Mapping */
$purposes = [
    "Yearly Fee"      => "",
    "New Membership" => "",
    "Lifetime Fee"   => "",
    "Scholarship"    => "",
    "Donation"       => "",
    "Others"       => ""
];

if(isset($purposes[$purpose])){
    $purposes[$purpose] = number_format($amount,2);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Receipt</title>
<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
body{ font-family: Mangal, Arial, sans-serif; }
.receipt-box{ width:700px;margin:auto;border:2px solid black;padding:10px; position: relative;}
.center{ text-align:center;font-weight:bold; }
table{ width:100%;border-collapse:collapse;margin-top:10px;font-size:15px; }
table,th,td{ border:1px solid black;padding:6px; }
.no-border{ border:none; }
.left{text-align:left;}
.right{text-align:right;}
.bold{ font-weight:bold; }
.info{
    position: absolute;
    bottom: 10px;
    left: 10px;
    font-size: 12px;
    font-weight: bold;
}

.signature{ margin-top:40px;text-align:right;font-weight:bold; }
.receipt-actions{
    text-align:center;
    margin:20px 0;
}

/* COMMON BUTTON STYLE */
.receipt-actions button{
    border: none;
    padding: 12px 28px;
    font-size: 15px;
    font-weight: bold;
    border-radius: 30px;
    cursor: pointer;
    margin: 0 8px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}

/* PRINT BUTTON */
.btn-print{
    background: linear-gradient(135deg,#2196f3,#0d47a1);
    color: #fff;
}

.btn-print:hover{
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(33,150,243,0.5);
}

/* DOWNLOAD BUTTON */
.btn-download{
    background: linear-gradient(135deg,#4caf50,#1b5e20);
    color: #fff;
}

.btn-download:hover{
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(76,175,80,0.5);
}

/* PRINT MODE – HIDE BUTTONS */
@media print{
    .receipt-actions{
        display:none;
    }
}

@media print {
    button {
        display: none;
    }
}

.receipt-header{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:20px;
    margin-bottom:10px;
}

.receipt-logo{
    width:170px;
    height:auto;
}

.center{
    flex:1;
    text-align:center;
    font-weight:bold;
}


</style>
</head>
<body>

<div class="receipt-actions">
    <button class="btn-print" onclick="printReceipt()">
        🖨️ Print Receipt
    </button>

    <button class="btn-download" onclick="downloadPDF()">
        ⬇️ Download PDF
    </button>
</div>

<!-- <a href=""></a> -->
 
<div class="receipt-box">

<div class="receipt-header">
    
    <div class="logo-left">
        <img src="upload/reclogo.png" class="receipt-logo">
    </div>

    <div class="center">
        || श्री महावीराय नमः || <br>
        श्री नागपुर प्रांतीय दिगम्बर जैन खण्डेलवाल सभा <br>
        पंजीयन ऑफिस - छिंदवाड़ा, पंजीयन नं. 173/53/54 <br>
        कार्यालय : इतवारी, भाजीमंडी, फूलओली  नागपुर (महाराष्ट्र)- 440002
    </div>

</div>

<table class="no-border">
<tr>
<td class="no-border left"><b>रसीद क्रमांक:</b><span class="fw-bold text-danger"> <?= $receipt_id ?></span></td>
<td class="no-border right"><b>दिनांक:</b> <span class="fw-bold text-danger"><?= $date ?></span> </td>
</tr>
</table>

<table>
<tr>
<td width="15%" class="bold">श्रीमान:</td>
<td class="fw-bold text-primary"><?= $member ?></td>
</tr>
<tr>
<td class="bold">शहर:</td>
<td class="fw-bold text-primary"><?= $city ?></td>
</tr>
</table>

<table>
<tr class="bold center">
<td width="10%">क्रमांक</td>
<td width="60%">नाम खाता</td>
<td width="30%">रकम</td>
</tr>

<tr><td>1</td><td>सालाना फीस</td><td class="right fw-bold text-danger"><?= $purposes["Yearly Fee"] ?></td></tr>
<tr><td>2</td><td>नई सदस्यता शुल्क</td><td class="right fw-bold text-danger"><?= $purposes["New Membership"] ?></td></tr>
<tr><td>3</td><td>आजीवन सदस्यता शुल्क</td><td class="right fw-bold text-danger"><?= $purposes["Lifetime Fee"] ?></td></tr>
<tr><td>4</td><td>छात्र वृत्ति की राशि</td><td class="right fw-bold text-danger"><?= $purposes["Scholarship"] ?></td></tr>
<tr><td>5</td><td><b>सहयोग राशि</b></td><td class="right fw-bold text-danger"><?= $purposes["Donation"] ?></td></tr>
<tr><td>6</td><td><b>अन्य शुल्क</b></td><td class="right fw-bold text-danger"><?= $purposes["Others"] ?></td></tr>


<tr>
<td colspan="2" class="right bold">कुल राशि -</td>
<td class="right  fw-bold text-danger"><?= number_format($amount,2) ?></td>
</tr>
</table>

<table>
    <tr>
        <td>Purpose : </td>
            <td><?= $desc ?></td>

    </tr>
<tr>
<td width="25%" class="bold">अक्षरी रुपया :</td>
<td class="fw-bold text-primary"><?= amountInWords($amount) ?></td>
</tr>

<tr>
    <td class="bold">Manual ID :</td>
    <td class="fw-bold text-danger"><?= $manID ?></td>

</tr>
</table>
<div class="info">* This is a Computer Generated Receipt</div>
<div class="signature">हस्ताक्षर प्राप्त कर्ता</div>

</div>


<!-- html2pdf library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function printReceipt(){
    window.print();
}

function downloadPDF(){
    const element = document.querySelector('.receipt-box');

    const opt = {
        margin:       0.3,
        filename:     'receipt_<?= $receipt_id ?>.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
}
</script>


</body>
</html>
