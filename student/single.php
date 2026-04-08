<?php
// Include database connection
include("../db.php");

// Get user ID from URL safely
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch student data
$sql = "SELECT * FROM student WHERE id = $user_id";
$result_data = $conn->query($sql);

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();

    // Assign values
    $id      = $row_data['id'];
    $name    = $row_data['name'];
    $mobile  = $row_data['mobile'];
    $address = $row_data['address'];
    $gender  = $row_data['gender'];
    $dob     = $row_data['dob'];
    $father  = $row_data['father_name'];
    $mother  = $row_data['mother_name'];
} else {
    // Redirect if no record
    header("Location: table.php");
    exit;
}

// Close connection
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student - View Record</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Card styling */
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

        <!-- View Card -->
        <div class="col-md-7">
            <div class="bg-white p-5 form-card">

                <!-- Title -->
                <h2 class="text-center mb-4">
                    <u>Student - View Record</u>
                </h2>

                <!-- Display Data -->
                <div class="row g-3">

                    <!-- Student ID -->
                    <div class="col-md-3">
                        <label class="form-label"><strong>Student ID:</strong></label>
                        <p><?= htmlspecialchars($id) ?></p>
                    </div>

                    <!-- Full Name -->
                    <div class="col-md-9">
                        <label class="form-label"><strong>Full Name:</strong></label>
                        <p><?= htmlspecialchars($name) ?></p>
                    </div>

                    <!-- Mobile -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Mobile Number:</strong></label>
                        <p><?= htmlspecialchars($mobile) ?></p>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Gender:</strong></label>
                        <p><?= htmlspecialchars(ucfirst($gender)) ?></p>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label class="form-label"><strong>Residential Address:</strong></label>
                        <p><?= htmlspecialchars($address) ?></p>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Date of Birth:</strong></label>
                        <p><?= htmlspecialchars($dob) ?></p>
                    </div>

                    <!-- Father Name -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Father's Name:</strong></label>
                        <p><?= htmlspecialchars($father) ?></p>
                    </div>

                    <!-- Mother Name -->
                    <div class="col-md-6">
                        <label class="form-label"><strong>Mother's Name:</strong></label>
                        <p><?= htmlspecialchars($mother) ?></p>
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 text-center mt-4">
                        <a class="btn btn-success px-4"
                           href="table.php">
                            Back
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
