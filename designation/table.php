<?php
include("../db.php");

$sql = "SELECT * FROM designation ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Designation - Record List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
                <h3 class="text-center text-primary mb-4">Designation - Record List</h3>

                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-success" href="add.php">+ Add</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Designation</th>
                                <th width="140">Action</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['designation']) ?></td>
            <td>
                <a class="btn btn-primary btn-sm" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='3' class='text-danger'>No records found</td></tr>";
}
?>
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
