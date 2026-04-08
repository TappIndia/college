<?php
$currentModule = basename(dirname($_SERVER['PHP_SELF']));
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="../student/table.php">College Management System</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Academic Module -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="academicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Academic
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="academicDropdown">
                        <li><a class="dropdown-item <?= $currentModule === 'departments' ? 'active' : '' ?>" href="../departments/table.php">Departments</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'courses' ? 'active' : '' ?>" href="../courses/table.php">Courses</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'classes' ? 'active' : '' ?>" href="../classes/table.php">Classes</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'subjects' ? 'active' : '' ?>" href="../subjects/table.php">Subjects</a></li>
                    </ul>
                </li>

                <!-- Management Module -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="managementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="managementDropdown">
                        <li><a class="dropdown-item <?= $currentModule === 'student' ? 'active' : '' ?>" href="../student/table.php">Students</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'staff' ? 'active' : '' ?>" href="../staff/table.php">Staff</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'designation' ? 'active' : '' ?>" href="../designation/table.php">Designations</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'enrollment' ? 'active' : '' ?>" href="../enrollment/table.php">Enrollment</a></li>
                    </ul>
                </li>

                <!-- Academics Module -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="examsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Exams & Results
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="examsDropdown">
                        <li><a class="dropdown-item <?= $currentModule === 'exam' ? 'active' : '' ?>" href="../exam/table.php">Exams</a></li>
                        <li><a class="dropdown-item <?= $currentModule === 'marks' ? 'active' : '' ?>" href="../marks/table.php">Marks</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
