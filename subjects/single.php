<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT s.*, c.course_name, st.name as teacher_name FROM subjects s 
        LEFT JOIN courses c ON s.course_id = c.id 
        LEFT JOIN staff st ON s.teacher_id = st.id 
        WHERE s.id = $user_id";
$result_data = $conn->query($sql);

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();
    $id = $row_data['id'];
    $subject_name = $row_data['subject_name'];
    $course_name = $row_data['course_name'] ?? 'Not Assigned';
    $teacher_name = $row_data['teacher_name'] ?? 'Not Assigned';
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
    <title>Subject - View Record</title>
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
                <h2 class="text-center mb-4"><u>Subject - View Record</u></h2>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label"><strong>ID:</strong></label>
                        <p><?= htmlspecialchars($id) ?></p>
                    </div>

                    <div class="col-md-9">
                        <label class="form-label"><strong>Subject Name:</strong></label>
                        <p><?= htmlspecialchars($subject_name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Course:</strong></label>
                        <p><?= htmlspecialchars($course_name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Teacher:</strong></label>
                        <p><?= htmlspecialchars($teacher_name) ?></p>
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
