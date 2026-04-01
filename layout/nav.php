<?php
$currentModule = basename(dirname($_SERVER['PHP_SELF']));
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../student/table.php">College Project</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $currentModule === 'student' ? 'active' : '' ?>" href="../student/table.php">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentModule === 'staff' ? 'active' : '' ?>" href="../staff/table.php">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentModule === 'designation' ? 'active' : '' ?>" href="../designation/table.php">Designations</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
