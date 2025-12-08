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
$date    = date("d-m-Y", strtotime($receipt['receipt_date']));
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
</style>
</head>
<body>

<div class="receipt-box">

<div class="center">
|| श्री महावीराय नमः || <br>
श्री नागपुर प्रांतीय दिगम्बर जैन खण्डेलवाल सभा <br>
पंजीयन ऑफिस - छिंदवाड़ा, पंजीयन नं. 173/53/54 <br>
कार्यालय - फल ऑत्री, इतवारी, नागपुर (महाराष्ट्र) - 440002
</div>

<table class="no-border">
<tr>
<td class="no-border left"><b>रसीद क्रमांक:</b> <?= $receipt_id ?></td>
<td class="no-border right"><b>दिनांक:</b> <?= $date ?></td>
</tr>
</table>

<table>
<tr>
<td width="15%" class="bold">श्रीमान:</td>
<td><?= $member ?></td>
</tr>
<tr>
<td class="bold">शहर:</td>
<td><?= $city ?></td>
</tr>
</table>

<table>
<tr class="bold center">
<td width="10%">क्रमांक</td>
<td width="60%">नाम खाता</td>
<td width="30%">रकम</td>
</tr>

<tr><td>1</td><td>सालाना फीस</td><td class="right"><?= $purposes["Yearly Fee"] ?></td></tr>
<tr><td>2</td><td>नई सदस्यता शुल्क</td><td class="right"><?= $purposes["New Membership"] ?></td></tr>
<tr><td>3</td><td>आजीवन सदस्यता शुल्क</td><td class="right"><?= $purposes["Lifetime Fee"] ?></td></tr>
<tr><td>4</td><td>छात्र वृत्ति की राशि</td><td class="right"><?= $purposes["Scholarship"] ?></td></tr>
<tr><td>5</td><td><b>सहयोग राशि</b></td><td class="right"><?= $purposes["Donation"] ?></td></tr>
<tr><td>6</td><td><b>अन्य शुल्क</b></td><td class="right"><?= $purposes["Others"] ?></td></tr>


<tr>
<td colspan="2" class="right bold">कुल राशि -</td>
<td class="right bold"><?= number_format($amount,2) ?></td>
</tr>
</table>

<table>
    <tr>
        <td>Purpose : </td>
            <td><?= $desc ?></td>

    </tr>
<tr>
<td width="25%" class="bold">अक्षरी रुपया :</td>
<td><?= amountInWords($amount) ?></td>
</tr>

<tr>
    <td class="bold">Manual ID :</td>
    <td><?= $manID ?></td>

</tr>
</table>
<div class="info">* This is a Computer Generated Receipt</div>
<div class="signature">हस्ताक्षर प्राप्त कर्ता</div>

</div>

<script>
// window.print();
</script>

</body>
</html>
