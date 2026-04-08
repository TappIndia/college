<?php
include("../db.php");

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT m.*, st.name as student_name, e.exam_name FROM marks m 
        LEFT JOIN student st ON m.student_id = st.id 
        LEFT JOIN exam e ON m.exam_id = e.id 
        WHERE m.id = $user_id";
$result_data = $conn->query($sql);

if ($result_data && $result_data->num_rows > 0) {
    $row_data = $result_data->fetch_assoc();
    $id = $row_data['id'];
    $student_name = $row_data['student_name'] ?? 'Not Assigned';
    $exam_name = $row_data['exam_name'] ?? 'Not Assigned';
    $marks_obtained = $row_data['marks_obtained'];
    $max_marks = $row_data['max_marks'];
    $percentage = ($max_marks > 0) ? round(($marks_obtained / $max_marks) * 100, 2) : 0;
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
    <title>Marks - View Record</title>
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
                <h2 class="text-center mb-4"><u>Marks - View Record</u></h2>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label"><strong>ID:</strong></label>
                        <p><?= htmlspecialchars($id) ?></p>
                    </div>

                    <div class="col-md-9"></div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Student:</strong></label>
                        <p><?= htmlspecialchars($student_name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Exam:</strong></label>
                        <p><?= htmlspecialchars($exam_name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Marks Obtained:</strong></label>
                        <p><?= htmlspecialchars($marks_obtained) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><strong>Max Marks:</strong></label>
                        <p><?= htmlspecialchars($max_marks) ?></p>
                    </div>

                    <div class="col-12">
                        <label class="form-label"><strong>Percentage:</strong></label>
                        <p><?= $percentage ?>%</p>
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
