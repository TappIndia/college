<?php
session_start();
// Include database connection
include("../db.php");

// Fetch all student records
$sql = "SELECT * FROM student ORDER BY id ASC";
$result = $conn->query($sql);

// Retrieve session feedback message, if any
$flashMessage = $_SESSION['message'] ?? null;
$flashType = $_SESSION['message_type'] ?? 'info';
unset($_SESSION['message'], $_SESSION['message_type']);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Student - Record List</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom UI improvements */
        .card-box {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        th {
            text-transform: uppercase;
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-primary bg-gradient">

<?php include("../layout/nav.php"); ?>

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-12">
            <div class="bg-white p-4 card-box">

                <!-- Heading -->
                <h3 class="text-center text-primary mb-4">
                    Student - Record List
                </h3>

                <!-- Flash Message -->
                <?php if (!empty($flashMessage)): ?>
                    <div class="alert alert-<?= htmlspecialchars($flashType) ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($flashMessage) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Add Button -->
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-success"
                       href="add.php">
                        + Add
                    </a>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">

                        <!-- Table Head -->
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Father</th>
                                <th>Mother</th>
                                <th width="200">Action</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>

<?php
// Check if records exist
if ($result && $result->num_rows > 0) {

    // Loop through data
    while ($row = $result->fetch_assoc()) {
?>

        <tr>
            <!-- Display each column safely -->
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['mobile']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= ucfirst($row['gender']) ?></td>
            <td><?= $row['dob'] ?></td>
            <td><?= htmlspecialchars($row['father_name']) ?></td>
            <td><?= htmlspecialchars($row['mother_name']) ?></td>

            <!-- Action Buttons -->
            <td>
                <a class="btn btn-primary btn-sm"
                   href="edit.php?id=<?= $row['id'] ?>">
                    Edit
                </a>

                <a class="btn btn-danger btn-sm"
                   href="delete.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Are you sure you want to delete this record?');">
                    Delete
                </a>

                <a class="btn btn-secondary btn-sm"
                   href="single.php?id=<?= $row['id'] ?>">
                    View
                </a>
            </td>
        </tr>

<?php
    }
} else {
    // If no data found
    echo "<tr><td colspan='9' class='text-danger'>No records found</td></tr>";
}
?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>