<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM classes WHERE id = $user_id";
$result_data = $conn->query($sql);
$course_result = $conn->query("SELECT id, course_name FROM courses ORDER BY course_name ASC");

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();
    $id = $row_data['id'];
    $class_name = $row_data['class_name'];
    $course_id = $row_data['course_id'];
    $year = $row_data['year'];
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
    <title>Class - Edit Record</title>
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
                <h2 class="text-center mb-4"><u>Class - Edit Record</u></h2>

                <form class="row g-3" action="update.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                    </div>

                    <div class="col-md-9">
                        <label for="class_name" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="class_name" name="class_name" value="<?= htmlspecialchars($class_name) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Course</label>
                        <select class="form-select" id="course_id" name="course_id">
                            <option value="">-- Select Course --</option>
<?php
if ($course_result && $course_result->num_rows > 0) {
    while ($course_row = $course_result->fetch_assoc()) {
?>
                            <option value="<?= $course_row['id'] ?>" <?= ((string)$course_id === (string)$course_row['id']) ? 'selected' : '' ?>><?= htmlspecialchars($course_row['course_name']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="<?= htmlspecialchars($year ?? '') ?>" min="1900" max="2999">
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
