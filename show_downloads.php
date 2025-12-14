<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

?>
<style>
  

    /* 📱 Mobile overflow fix */
@media (max-width: 768px){



    /* Download card full width */
    .download-card{
        width: 100% !important;
        padding: 15px;
    }

    /* Table text smaller */
    .mobile-table table{
        font-size: 14px;
    }

    .mobile-table th,
    .mobile-table td{
        padding: 8px;
        white-space: nowrap;
    }

    /* Optional: hide remark on very small screens */
    
}

</style>

<main>
<div class="d-flex flex-column flex-lg-row min-vh-100 ">

    <?php include('userDashboard.php'); ?>

<div class="flex-grow-1 p-3 p-lg-4 w-100 overflow-hidden
            d-flex justify-content-center align-items-start">
        <div class="download-card animate-entry w-100">

            <h4 class="text-center mb-4  fw-bold">📥 Download Center</h4>

            <?php
            $result = mysqli_query($con, "SELECT * FROM sens_downloads where downshow='members' ORDER BY id DESC");
            ?>

            <div class="table-responsive mobile-table">
                <table class="table table-hover align-middle text-center glass-table">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Remark</th>
                            <th>File</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="table-row-animate">
                                <td><?= $row['topic'] ?></td>
                                <td><?= $row['remark'] ?></td>
                                <td>
                                    <a href="upload/<?= $row['file_name'] ?>" download
                                       class="btn btn-download">
                                       Download
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
