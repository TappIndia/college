<?php
include("../db.php");

$sql = "SELECT MAX(id) AS max_id FROM exam";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maxid = ($row['max_id'] !== null) ? $row['max_id'] + 1 : 1;
} else {
    $maxid = 1;
}

$subject_sql = "SELECT id, subject_name FROM subjects ORDER BY subject_name ASC";
$subject_result = $conn->query($subject_sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam - Add Record</title>
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
                <h2 class="text-center mb-4"><u>Exam - Add Record</u></h2>

                <form class="row g-3" action="create.php" method="post">
                    <div class="col-md-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $maxid ?>" readonly>
                    </div>

                    <div class="col-md-9">
                        <label for="exam_name" class="form-label">Exam Name</label>
                        <input type="text" class="form-control" id="exam_name" name="exam_name" placeholder="Enter exam name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select class="form-select" id="subject_id" name="subject_id" required>
                            <option value="">-- Select Subject --</option>
<?php
if ($subject_result && $subject_result->num_rows > 0) {
    while ($subject_row = $subject_result->fetch_assoc()) {
?>
                            <option value="<?= $subject_row['id'] ?>"><?= htmlspecialchars($subject_row['subject_name']) ?></option>
<?php
    }
}
?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="exam_date" class="form-label">Exam Date</label>
                        <input type="date" class="form-control" id="exam_date" name="exam_date">
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
