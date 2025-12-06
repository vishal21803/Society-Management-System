<?php
include("connectdb.php");
$mid = $_GET['mid'];
?>

<h5>Insert Payment</h5>

<form method="post" action="add_payment.php">
<input type="hidden" name="member_id" value="<?= $mid ?>">

<label>Amount</label>
<input type="number" name="amount" class="form-control" required>

<!-- <label>Payment For Year</label>
<input type="number" name="payment_for_year" class="form-control" placeholder="2024" required>

<label>Receipt No</label>
<input type="text" name="receipt_no" class="form-control">
-->

<label>Note</label>
<textarea name="note" class="form-control"></textarea> 

<button class="btn btn-success mt-3">Save Payment</button>
</form>

<script>
    function insertBill(member_id){
    $.post('admin_ajax.php', {member_id: member_id}, function(data){
        $('#billFormBody').html(data);
        $('#billModal').modal('show');
    });
}
</script>