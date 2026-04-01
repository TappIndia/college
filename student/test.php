<?php
include("../db.php");

$total_students = 0;
$student_result = $conn->query("SELECT COUNT(*) AS total_students FROM student");
if ($student_result && $student_result->num_rows > 0) {
    $total_students = (int)$student_result->fetch_assoc()['total_students'];
}

$recent_students = $conn->query("SELECT id, name, mobile, gender FROM student ORDER BY id DESC LIMIT 5");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student - Test Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-box {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">

<?php include("../layout/nav.php"); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="bg-white p-4 card-box">
                <h2 class="text-center text-primary mb-3">Student Module Test Page</h2>
                <p class="text-center text-muted mb-4">Use these options to quickly test the student CRUD module.</p>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100 bg-success-subtle">
                            <h5 class="mb-2">Database Status</h5>
                            <p class="mb-0">Connected to <strong>`college`</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100 bg-info-subtle">
                            <h5 class="mb-2">Student Records</h5>
                            <p class="mb-0"><strong><?= $total_students ?></strong> record(s) found</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100 bg-warning-subtle">
                            <h5 class="mb-2">Quick Test</h5>
                            <p class="mb-0">Try add, edit, view, and delete</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                    <a class="btn btn-primary" href="add.php">Add</a>
                    <a class="btn btn-success" href="table.php">View</a>
                </div>

                <h5 class="mb-3">Suggested testing steps</h5>
                <ol>
                    <li>Open <code>Add</code> and create a new record.</li>
                    <li>Go to <code>View</code> and confirm the row appears.</li>
                    <li>Use <code>Edit</code> to update the record.</li>
                    <li>Use <code>View</code> to verify the details.</li>
                    <li>Use <code>Delete</code> to confirm removal works.</li>
                </ol>

                <h5 class="mt-4 mb-3">Recent students</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                            </tr>
                        </thead>
                        <tbody>
<?php if ($recent_students && $recent_students->num_rows > 0) { ?>
<?php while ($row = $recent_students->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['mobile']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($row['gender'])) ?></td>
                            </tr>
<?php } ?>
<?php } else { ?>
                            <tr>
                                <td colspan="4" class="text-danger">No student records found</td>
                            </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
