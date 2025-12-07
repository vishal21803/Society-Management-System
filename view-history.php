<?php
include("connectdb.php");
$mid = $_GET['mid'];

$q = mysqli_query($con,"
SELECT * FROM sens_payments
WHERE member_id='$mid'
ORDER BY payment_for_year DESC
");

echo "<h5>Payment History</h5>";
echo "<table class='table table-striped'>";
echo "<tr>
<th>Year</th>
<th>Amount</th>
<th>Date</th>
<th>Receipt</th>
</tr>";

while($row = mysqli_fetch_assoc($q)){
echo "<tr>
<td>{$row['payment_for_year']}</td>
<td>₹{$row['amount']}</td>
<td>{$row['payment_date']}</td>
<td>{$row['receipt_no']}</td>
</tr>";
}
echo "</table>";
?>
