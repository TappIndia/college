<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM courses WHERE id = $user_id";
$result_data = $conn->query($sql);
$dept_result = $conn->query("SELECT id, dept_name FROM departments ORDER BY dept_name ASC");

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();
    $id = $row_data['id'];
    $course_name = $row_data['course_name'];
    $dept_id = $row_data['dept_id'];
    $duration = $row_data['duration'];
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
    <title>Course - Edit Record</title>
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
                <h2 class="text-center mb-4"><u>Course - Edit Record</u></h2>

                <form class="row g-3" action="update.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                    </div>

                    <div class="col-md-9">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?= htmlspecialchars($course_name) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="dept_id" class="form-label">Department</label>
                        <select class="form-select" id="dept_id" name="dept_id">
                            <option value="">-- Select Department --</option>
<?php
if ($dept_result && $dept_result->num_rows > 0) {
    while ($dept_row = $dept_result->fetch_assoc()) {
?>
                            <option value="<?= $dept_row['id'] ?>" <?= ((string)$dept_id === (string)$dept_row['id']) ? 'selected' : '' ?>><?= htmlspecialchars($dept_row['dept_name']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="duration" class="form-label">Duration (Years)</label>
                        <input type="number" class="form-control" id="duration" name="duration" value="<?= htmlspecialchars($duration ?? '') ?>">
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
