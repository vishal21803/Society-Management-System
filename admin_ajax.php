<?php
include("connectdb.php");
$member_id = $_POST['member_id'];

// Get member plan & start/end date
$m = mysqli_fetch_assoc(mysqli_query($con,"SELECT m.*, p.duration_days, p.price FROM members m JOIN plans p ON m.plan_id=p.plan_id WHERE m.member_id='$member_id'"));

// Calculate pending years
$startYear = date('Y', strtotime($m['plan_start_date']));
$endYear = date('Y', strtotime($m['plan_end_date']));
$currYear = date('Y');
$pendingYears = [];

for($y=$startYear; $y<=$currYear; $y++){
    $chk = mysqli_query($con,"SELECT * FROM payments WHERE member_id='$member_id' AND payment_for_year='$y'");
    if(mysqli_num_rows($chk)==0){
        $pendingYears[] = $y;
    }
}

$totalDue = count($pendingYears) * $m['price'];

echo "<form id='insertPaymentForm'>
    <input type='hidden' name='member_id' value='$member_id'>
    <div class='mb-2'>Member: <b>{$m['fullname']}</b></div>
    <div class='mb-2'>Pending Years: ".implode(", ", $pendingYears)."</div>
    <div class='mb-2'>Total Due: ₹$totalDue</div>
    <div class='mb-3'>
        <label>Pay Year</label>
        <select name='payment_for_year' class='form-select' required>";
foreach($pendingYears as $py){
    echo "<option value='$py'>$py</option>";
}
echo "</select></div>
    <div class='mb-3'>
        <label>Amount</label>
        <input type='number' name='amount' class='form-control' value='{$m['price']}' required>
    </div>
    <button class='btn btn-success'>Submit Payment</button>
</form>
<script>
$('#insertPaymentForm').on('submit', function(e){
    e.preventDefault();
    $.post('add_payment.php', $(this).serialize(), function(res){
        alert(res);
        $('#billModal').modal('hide');
    });
});
</script>";
?>
