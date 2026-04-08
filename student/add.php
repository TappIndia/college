<?php
session_start();
// Include database connection
include("../db.php");

// Get next ID (basic method - better to use AUTO_INCREMENT in DB)
$sql = "SELECT MAX(id) AS max_id FROM student";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maxid = ($row['max_id'] !== null) ? $row['max_id'] + 1 : 1;
} else {
    $maxid = 1;
}

$flashMessage = $_SESSION['message'] ?? null;
$flashType = $_SESSION['message_type'] ?? 'info';
unset($_SESSION['message'], $_SESSION['message_type']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student - Add Record</title>

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
                    <u>Student - Add Record</u>
                </h2>

                <!-- Flash Message -->
                <?php if (!empty($flashMessage)): ?>
                    <div class="alert alert-<?= htmlspecialchars($flashType) ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($flashMessage) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form class="row g-3" action="create.php" method="post">

                    <!-- Student ID -->
                    <div class="col-md-3">
                        <label for="id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="id" name="id"
                               value="<?php echo $maxid ?>" readonly>
                    </div>

                    <!-- Full Name -->
                    <div class="col-md-9">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter your full name" required>
                    </div>

                    <!-- Mobile -->
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile"
                               placeholder="Enter your mobile number">
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">-- Select Gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label for="address" class="form-label">Residential Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Enter your residential address">
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>

                    <!-- Father Name -->
                    <div class="col-md-6">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father" name="father"
                               placeholder="Enter your father's name">
                    </div>

                    <!-- Mother Name -->
                    <div class="col-md-6">
                        <label for="mother" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mother" name="mother"
                               placeholder="Enter your mother's name">
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 text-center mt-4">

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary px-4 me-2">
                            Save
                        </button>

                        <!-- Reset -->
                        <button type="reset" class="btn btn-outline-secondary px-4 me-2">
                            Reset
                        </button>

                        <!-- View Data -->
                        <a class="btn btn-success px-4"
                           href="table.php">
                            View
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