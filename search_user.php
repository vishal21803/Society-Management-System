<?php
include("connectdb.php");

$name = $_POST['name'];

$q = mysqli_query($con,"
    SELECT *
    FROM sens_members 
    
    WHERE fullname LIKE '%$name%' 
    
");

if(mysqli_num_rows($q) == 0){
    echo "<div class='alert alert-danger'>No user found</div>";
    exit;
}
?>

<div class="list-group shadow-sm">

<?php while($row = mysqli_fetch_assoc($q)){ ?>

    <div class="list-group-item d-flex justify-content-between align-items-center">
        
        <!-- USER INFO -->
        <div class="d-flex align-items-center gap-3">
            <img src="upload/member/<?= $row['photo'] ?>" 
                 style="width:50px;height:50px;border-radius:50%;object-fit:cover;">

            <div>
                <b><?= $row['fullname'] ?></b><br>
                <small class="text-muted"><?= $row['phone'] ?></small>
            </div>
        </div>

        <!-- BUTTONS -->
        <div>
           <button class="btn btn-warning btn-sm" onclick="editUser(<?= $row['user_id'] ?>)">
    Edit
</button>



            <button class="btn btn-sm btn-danger"
                onclick="deleteUser(<?= $row['member_id'] ?>)">
                Delete
            </button>
        </div>

    </div>

<?php } ?>



</div>
