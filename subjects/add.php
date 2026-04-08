<?php
include("../db.php");

$sql = "SELECT MAX(id) AS max_id FROM subjects";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maxid = ($row['max_id'] !== null) ? $row['max_id'] + 1 : 1;
} else {
    $maxid = 1;
}

$course_sql = "SELECT id, course_name FROM courses ORDER BY course_name ASC";
$course_result = $conn->query($course_sql);
$teacher_sql = "SELECT id, name FROM staff ORDER BY name ASC";
$teacher_result = $conn->query($teacher_sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subject - Add Record</title>
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
                <h2 class="text-center mb-4"><u>Subject - Add Record</u></h2>

                <form class="row g-3" action="create.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $maxid ?>" readonly>
                    </div>

                    <div class="col-md-9">
                        <label for="subject_name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter subject name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Course</label>
                        <select class="form-select" id="course_id" name="course_id" required>
                            <option value="">-- Select Course --</option>
<?php
if ($course_result && $course_result->num_rows > 0) {
    while ($course_row = $course_result->fetch_assoc()) {
?>
                            <option value="<?= $course_row['id'] ?>"><?= htmlspecialchars($course_row['course_name']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="teacher_id" class="form-label">Teacher</label>
                        <select class="form-select" id="teacher_id" name="teacher_id">
                            <option value="">-- Select Teacher --</option>
<?php
if ($teacher_result && $teacher_result->num_rows > 0) {
    while ($teacher_row = $teacher_result->fetch_assoc()) {
?>
                            <option value="<?= $teacher_row['id'] ?>"><?= htmlspecialchars($teacher_row['name']) ?></option>
<?php
    }
}
?>
                        </select>
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
