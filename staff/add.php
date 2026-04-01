<?php
include("../db.php");

$sql = "SELECT MAX(id) AS max_id FROM staff";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maxid = ($row['max_id'] !== null) ? $row['max_id'] + 1 : 1;
} else {
    $maxid = 1;
}

$designation_sql = "SELECT id, designation FROM designation ORDER BY designation ASC";
$designation_result = $conn->query($designation_sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff - Add Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .form-card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-info">

<?php include("../layout/nav.php"); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="bg-white p-5 form-card">
                <h2 class="text-center mb-4"><u>Staff - Add Record</u></h2>

                <form class="row g-3" action="create.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">Staff ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $maxid ?>" readonly>
                    </div>

                    <div class="col-md-9">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter staff name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number">
                    </div>

                    <div class="col-md-6">
                        <label for="e_mail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="e_mail" name="e_mail" placeholder="Enter email address">
                    </div>

                    <div class="col-md-6">
                        <label for="designation_id" class="form-label">Designation</label>
                        <select class="form-select" id="designation_id" name="designation_id">
                            <option value="">-- Select Designation --</option>
<?php
if ($designation_result && $designation_result->num_rows > 0) {
    while ($designation_row = $designation_result->fetch_assoc()) {
?>
                            <option value="<?= $designation_row['id'] ?>"><?= htmlspecialchars($designation_row['designation']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" step="0.01" class="form-control" id="salary" name="salary" placeholder="Enter salary">
                    </div>

                    <div class="col-12">
                        <label for="date_of_joining" class="form-label">Date of Joining</label>
                        <input type="date" class="form-control" id="date_of_joining" name="date_of_joining">
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 me-2">Save</button>
                        <button type="reset" class="btn btn-outline-secondary px-4 me-2">Reset</button>
                        <a class="btn btn-success px-4" href="table.php">View</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
