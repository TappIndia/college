<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT s.*, d.designation AS designation_name
        FROM staff s
        LEFT JOIN designation d ON s.designation_id = d.id
        WHERE s.id = $user_id";
$result_data = $conn->query($sql);

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();

    $id = $row_data['id'];
    $name = $row_data['name'];
    $mobile = $row_data['mobile'];
    $e_mail = $row_data['e_mail'];
    $designation_name = $row_data['designation_name'] ?? 'Not Assigned';
    $salary = $row_data['salary'];
    $date_of_joining = $row_data['date_of_joining'];
} else {
    header("Location: table.php");
    exit;
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff - View Record</title>
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
                <h2 class="text-center mb-4"><u>Staff - View Record</u></h2>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label"><strong>Staff ID:</strong></label>
                        <p><?= htmlspecialchars($id) ?></p>
                    </div>

                    <div class="col-md-9">
                        <label class="form-label"><strong>Full Name:</strong></label>
                        <p><?= htmlspecialchars($name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Mobile Number:</strong></label>
                        <p><?= htmlspecialchars($mobile) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Email Address:</strong></label>
                        <p><?= htmlspecialchars($e_mail) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Designation:</strong></label>
                        <p><?= htmlspecialchars($designation_name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Salary:</strong></label>
                        <p><?= htmlspecialchars($salary) ?></p>
                    </div>

                    <div class="col-12">
                        <label class="form-label"><strong>Date of Joining:</strong></label>
                        <p><?= htmlspecialchars($date_of_joining) ?></p>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <a class="btn btn-success px-4" href="table.php">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
