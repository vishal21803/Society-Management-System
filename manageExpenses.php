<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin') {

include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">
    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="card shadow border-0">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-cash-coin me-2"></i> Manage Expenses</span>
                <a href="javascript:void(0)" class="btn btn-success btn-sm"
                   data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                    + Add Expense
                </a>
            </div>

            <div class="card-body">
                <?php if(isset($_GET['msg']) && $_GET['msg'] == 'updated'){ ?>
    <div class="alert alert-success alert-dismissible fade show">
        ✅ Expense updated successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php } ?>


                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="myTable">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Expense Type</th>
                                <th>Amount (₹)</th>
                                <th>Date</th>
                                <th>Remark</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        $i=1;
                        $q = mysqli_query($con,"SELECT * FROM sens_expenses ORDER BY expense_id DESC");
                        while($row=mysqli_fetch_assoc($q)){
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['expense_type']) ?></td>
                            <td class="text-end fw-bold">₹ <?= number_format($row['expense_amount'],2) ?></td>
                            <td class="text-center"><?= date("d-m-Y", strtotime($row['expense_date'])) ?></td>
                            <td><?= htmlspecialchars($row['expense_remark']) ?></td>
                            <td class="text-center">
                                    <button title="Edit" class="btn btn-sm btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#editExpense<?= $row['expense_id'] ?>">
        <i class="bi bi-pencil"></i>
    </button>

                                <button title="Delete" class="btn btn-sm btn-danger"
                                    onclick="deleteExpense(<?= $row['expense_id'] ?>)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- ================= EDIT EXPENSE MODAL ================= -->
<div class="modal fade" id="editExpense<?= $row['expense_id'] ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="updateExpense.php">

        <input type="hidden" name="expense_id"
               value="<?= $row['expense_id'] ?>">

        <div class="modal-header bg-warning">
          <h5 class="modal-title">Edit Expense</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- EXPENSE TYPE -->
          <div class="mb-2">
            <label>Expense Type</label>
            <select class="form-select"
                    onchange="editCheckOther(this, <?= $row['expense_id'] ?>)">
                <option value="Electricity" <?= $row['expense_type']=="Electricity"?"selected":"" ?>>Electricity</option>
                <option value="Rent" <?= $row['expense_type']=="Rent"?"selected":"" ?>>Rent</option>
                <option value="Salary" <?= $row['expense_type']=="Salary"?"selected":"" ?>>Salary</option>
                <option value="Maintenance" <?= $row['expense_type']=="Maintenance"?"selected":"" ?>>Maintenance</option>
                <option value="Other">Other</option>
            </select>
          </div>

          <!-- OTHER -->
          <div class="mb-2 d-none" id="editOtherBox<?= $row['expense_id'] ?>">
            <label>Other Expense Type</label>
            <input type="text"
                   class="form-control"
                   value="<?= $row['expense_type'] ?>"
                   oninput="document.getElementById('editFinal<?= $row['expense_id'] ?>').value=this.value">
          </div>

          <!-- FINAL -->
          <input type="hidden"
                 name="expense_type"
                 id="editFinal<?= $row['expense_id'] ?>"
                 value="<?= $row['expense_type'] ?>">

          <div class="mb-2">
            <label>Amount</label>
            <input type="number" name="expense_amount"
                   value="<?= $row['expense_amount'] ?>"
                   class="form-control" required>
          </div>

          <div class="mb-2">
            <label>Date</label>
            <input type="date" name="expense_date"
       value="<?= date('Y-m-d', strtotime($row['expense_date'])) ?>"
       class="form-control" required>
          </div>

          <div class="mb-2">
            <label>Remark</label>
            <textarea name="expense_remark"
                      class="form-control"
                      rows="3"><?= $row['expense_remark'] ?></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-success">Update Expense</button>
        </div>

      </form>

    </div>
  </div>
</div>

                        <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- ================= ADD EXPENSE MODAL ================= -->
<div class="modal fade" id="addExpenseModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Expense</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <!-- SUCCESS MESSAGE -->
        <div id="expenseSuccess" class="alert alert-success d-none">
            ✅ Expense added successfully
        </div>

        <form id="expenseForm">

          <!-- EXPENSE TYPE -->
          <div class="mb-2">
            <label>Expense Type</label>
            <select id="expense_type" class="form-select"
                    onchange="checkOtherExpense()" required>
                <option value="">-- Select Expense Type --</option>
                <option value="Electricity">Electricity</option>
                <option value="Rent">Rent</option>
                <option value="Salary">Salary</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Other">Other</option>
            </select>
          </div>

          <!-- OTHER TYPE -->
          <div class="mb-2 d-none" id="otherExpenseBox">
            <label>Other Expense Type</label>
            <input type="text" id="other_expense"
                   class="form-control"
                   placeholder="Enter expense type">
          </div>

          <!-- FINAL VALUE -->
          <input type="hidden" name="expense_type" id="final_expense_type">

          <div class="mb-2">
            <label>Amount</label>
            <input type="number" name="expense_amount" class="form-control" required>
          </div>

          <div class="mb-2">
            <label>Date</label>
            <input type="date" name="expense_date"
                   value="<?= date('Y-m-d') ?>" class="form-control" required>
          </div>

          <div class="mb-2">
            <label>Remark</label>
            <textarea name="expense_remark" class="form-control" rows="3"></textarea>
          </div>

          <button type="submit" class="btn btn-success w-100">
            Save Expense
          </button>

        </form>

      </div>

    </div>
  </div>
</div>
</main>

<script>
function deleteExpense(id){
    if(confirm("Are you sure to delete this expense?")){
        window.location = "deleteExpense.php?id="+id;
    }
}

/* EXPENSE TYPE LOGIC */
function checkOtherExpense(){
    let select = document.getElementById("expense_type");
    let otherBox = document.getElementById("otherExpenseBox");
    let finalInput = document.getElementById("final_expense_type");

    if(select.value === "Other"){
        otherBox.classList.remove("d-none");
        finalInput.value = "";
    } else {
        otherBox.classList.add("d-none");
        finalInput.value = select.value;
    }
}

/* OTHER INPUT */
document.getElementById("other_expense").addEventListener("input", function(){
    document.getElementById("final_expense_type").value = this.value;
});

/* SAVE EXPENSE */
document.getElementById("expenseForm").addEventListener("submit", function(e){
    e.preventDefault();

    let final = document.getElementById("final_expense_type").value.trim();

    if(final === ""){
        alert("Please select or enter expense type");
        return;
    }

    let formData = new FormData(this);

    fetch("saveExpense.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        if(data.trim() === "success"){
              let successBox = document.getElementById("expenseSuccess");

    successBox.classList.remove("d-none");
    document.getElementById("expenseForm").reset();
    document.getElementById("otherExpenseBox").classList.add("d-none");

    // ⏳ AUTO HIDE AFTER 3 SECONDS
    setTimeout(() => {
        successBox.classList.add("d-none");
    }, 3000);
        } else {
            alert("Error saving expense");
        }
    });
});

/* MODAL CLOSE => PAGE RELOAD */
document.getElementById('addExpenseModal').addEventListener('hidden.bs.modal', function () {
    location.reload();
});


function editCheckOther(select, id){
    let otherBox = document.getElementById("editOtherBox"+id);
    let finalInput = document.getElementById("editFinal"+id);

    if(select.value === "Other"){
        otherBox.classList.remove("d-none");
        finalInput.value = "";
    } else {
        otherBox.classList.add("d-none");
        finalInput.value = select.value;
    }
}

setTimeout(() => {
    let alert = document.querySelector('.alert');
    if(alert){
        alert.classList.remove('show');
        alert.classList.add('fade');
    }
}, 3000);
</script>

<?php
include("footer.php");
} else {
    include("index.php");
}
?>
