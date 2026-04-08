<?php
// Include database connection
include("../db.php");

// Get user ID from URL safely (cast to integer)
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch student data from DB
$sql = "SELECT * FROM student WHERE id = $user_id";
$result_data = $conn->query($sql);

// Check if record exists
if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();

    // Assign values to variables for easy use in form
    $id      = $row_data['id'];
    $name    = $row_data['name'];
    $mobile  = $row_data['mobile'];
    $address = $row_data['address'];
    $gender  = $row_data['gender'];
    $dob     = $row_data['dob'];
    $father  = $row_data['father_name'];
    $mother  = $row_data['mother_name'];
} else {
    // Redirect if no record found
    header("Location: table.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student - Edit Record</title>

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

        <!-- Form Card -->
        <div class="col-md-7">
            <div class="bg-white p-5 form-card">

                <!-- Title -->
                <h2 class="text-center mb-4">
                    <u>Student - Edit Record</u>
                </h2>

                <!-- Form -->
                <form class="row g-3" action="update.php" method="post">

                    <!-- Student ID -->
                    <div class="col-md-3">
                        <label for="id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="id" name="id"
                               value="<?= $id ?>" readonly>
                    </div>

                    <!-- Full Name -->
                    <div class="col-md-9">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?= htmlspecialchars($name) ?>" placeholder="Enter your full name" required>
                    </div>

                    <!-- Mobile -->
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile"
                               value="<?= htmlspecialchars($mobile) ?>" placeholder="Enter your mobile number">
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">-- Select Gender --</option>
                            <option value="male" <?= $gender == 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $gender == 'female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label for="address" class="form-label">Residential Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                               value="<?= htmlspecialchars($address) ?>" placeholder="Enter your residential address">
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= $dob ?>">
                    </div>

                    <!-- Father Name -->
                    <div class="col-md-6">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father" name="father"
                               value="<?= htmlspecialchars($father) ?>" placeholder="Enter your father's name">
                    </div>

                    <!-- Mother Name -->
                    <div class="col-md-6">
                        <label for="mother" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mother" name="mother"
                               value="<?= htmlspecialchars($mother) ?>" placeholder="Enter your mother's name">
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 text-center mt-4">

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary px-4 me-2">
                            Update
                        </button>

                        <!-- Reset -->
                        <button type="reset" class="btn btn-outline-secondary px-4 me-2">
                            Reset
                        </button>

                        <!-- View Data -->
                        <a class="btn btn-success px-4"
                           href="table.php">
                            Back
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>