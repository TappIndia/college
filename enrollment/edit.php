<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM enrollment WHERE id = $user_id";
$result_data = $conn->query($sql);
$student_result = $conn->query("SELECT id, name FROM student ORDER BY name ASC");
$class_result = $conn->query("SELECT id, class_name FROM classes ORDER BY class_name ASC");

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();
    $id = $row_data['id'];
    $student_id = $row_data['student_id'];
    $class_id = $row_data['class_id'];
    $admission_date = $row_data['admission_date'];
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
    <title>Enrollment - Edit Record</title>
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
                <h2 class="text-center mb-4"><u>Enrollment - Edit Record</u></h2>

                <form class="row g-3" action="update.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                    </div>

                    <div class="col-md-9"></div>

                    <div class="col-md-6">
                        <label for="student_id" class="form-label">Student</label>
                        <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">-- Select Student --</option>
<?php
if ($student_result && $student_result->num_rows > 0) {
    while ($student_row = $student_result->fetch_assoc()) {
?>
                            <option value="<?= $student_row['id'] ?>" <?= ((string)$student_id === (string)$student_row['id']) ? 'selected' : '' ?>><?= htmlspecialchars($student_row['name']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="class_id" class="form-label">Class</label>
                        <select class="form-select" id="class_id" name="class_id" required>
                            <option value="">-- Select Class --</option>
<?php
if ($class_result && $class_result->num_rows > 0) {
    while ($class_row = $class_result->fetch_assoc()) {
?>
                            <option value="<?= $class_row['id'] ?>" <?= ((string)$class_id === (string)$class_row['id']) ? 'selected' : '' ?>><?= htmlspecialchars($class_row['class_name']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="admission_date" class="form-label">Admission Date</label>
                        <input type="date" class="form-control" id="admission_date" name="admission_date" value="<?= htmlspecialchars($admission_date ?? '') ?>">
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
