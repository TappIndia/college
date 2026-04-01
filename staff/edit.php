<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM staff WHERE id = $user_id";
$result_data = $conn->query($sql);
$designation_result = $conn->query("SELECT id, designation FROM designation ORDER BY designation ASC");

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();

    $id = $row_data['id'];
    $name = $row_data['name'];
    $mobile = $row_data['mobile'];
    $e_mail = $row_data['e_mail'];
    $designation_id = $row_data['designation_id'];
    $salary = $row_data['salary'];
    $date_of_joining = $row_data['date_of_joining'];
} else {
    header("Location: table.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff - Edit Record</title>
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
                <h2 class="text-center mb-4"><u>Staff - Edit Record</u></h2>

                <form class="row g-3" action="update.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">Staff ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                    </div>

                    <div class="col-md-9">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlspecialchars($mobile) ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="e_mail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="e_mail" name="e_mail" value="<?= htmlspecialchars($e_mail) ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="designation_id" class="form-label">Designation</label>
                        <select class="form-select" id="designation_id" name="designation_id">
                            <option value="">-- Select Designation --</option>
<?php
if ($designation_result && $designation_result->num_rows > 0) {
    while ($designation_row = $designation_result->fetch_assoc()) {
?>
                            <option value="<?= $designation_row['id'] ?>" <?= ((string)$designation_id === (string)$designation_row['id']) ? 'selected' : '' ?>><?= htmlspecialchars($designation_row['designation']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" step="0.01" class="form-control" id="salary" name="salary" value="<?= htmlspecialchars($salary) ?>">
                    </div>

                    <div class="col-12">
                        <label for="date_of_joining" class="form-label">Date of Joining</label>
                        <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" value="<?= htmlspecialchars($date_of_joining) ?>">
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 me-2">Update</button>
                        <button type="reset" class="btn btn-outline-secondary px-4 me-2">Reset</button>
                        <a class="btn btn-success px-4" href="table.php">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
