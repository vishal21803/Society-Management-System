<?php 
@session_start();
include("header.php");
include("connectdb.php");
?>

<br><br>
<main>
<div class="container my-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark fw-bold text-center fs-4">
            ✅ Register New Member
        </div>

        <div class="card-body p-4">

            <form action="saveusermem.php" method="POST">

                <!-- ✅ Full Name -->
                <div class="mb-3">
                    <label class="fw-bold">Full Name</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>

                <!-- ✅ Email -->
                <div class="mb-3">
                    <label class="fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- ✅ Phone -->
                <div class="mb-3">
                    <label class="fw-bold">Phone Number</label>
                    <input type="number" name="phone" class="form-control" required>
                </div>

                <!-- ✅ Zone -->
                <div class="mb-3">
                    <label class="fw-bold">Zone</label>
                    <select name="zone_id" id="zoneDropdown" class="form-select" required onchange="loadCities()">
                        <option value="">-- Select Zone --</option>
                        <?php
                        $rs = mysqli_query($con,"SELECT * FROM sens_zones ORDER BY zone_name ASC");
                        while($z = mysqli_fetch_assoc($rs)){
                            echo "<option value='{$z['zone_id']}'>{$z['zone_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- ✅ City -->
                <div class="mb-3">
                    <label class="fw-bold">City</label>
                    <select name="city_id" id="cityDropdown" class="form-select" required>
                        <option value="">-- Select City --</option>
                    </select>
                </div>

                <!-- ✅ Membership Plan -->
                <div class="mb-4">
                    <label class="fw-bold">Select Membership Plan</label>
                    <select name="plan_id" class="form-select" required>
                        <?php
                        $pr = mysqli_query($con,"SELECT * FROM sens_plans order by plan_id desc");
                        while($p = mysqli_fetch_assoc($pr)){
                            echo "<option value='{$p['plan_id']}'>
                                    {$p['name']} - ₹{$p['price']}
                                  </option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- ✅ Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 fw-bold">
                        ✅ Register Member
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
</main>

<?php include("footer.php"); ?>
