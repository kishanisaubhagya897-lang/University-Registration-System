<?php include "includes/auth.php"; ?>
<?php include "includes/config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<?php
$totalStudents = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM students")
);

$totalMale = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM students WHERE gender='Male'")
);

$totalFemale = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM students WHERE gender='Female'")
);

$recentStudents = mysqli_query(
    $conn,"SELECT full_name, course FROM students ORDER BY created_at DESC LIMIT 5"
);
?>

<div class="main">

<img src="assets/images/IMBSPHOTO.jpg" class="hero-img" alt="University Image">

<!-- STATISTICS SECTION -->
<div class="stats">

    <div class="stat-box">
        <h3>Total Students</h3>
        <h1><?php echo $totalStudents['total']; ?></h1>
    </div>
    
    <div class="stat-box">
        <h3>Male Students</h3>
        <h1><?php echo $totalMale['total']; ?></h1>
    </div>

    <div class="stat-box">
        <h3>Female Students</h3>
        <h1><?php echo $totalFemale['total']; ?></h1>
    </div>

</div>

<!-- QUICK ACTIONS -->
<div class="card">
    <h2>Quick Actions</h2>
    <div class="dashboard-actions">
        <a href="register_student.php" class="action-btn">➕ Register Student</a>
        <a href="view_students.php" class="action-btn">📋 View Students</a>
        <a href="courses.php" class="action-btn">🎓 Manage Courses</a>
    </div>
</div>

<!-- RECENT STUDENTS -->
<div class="card">
    <h2>Recently Registered Students</h2>

    <table class="styled-table">
        <tr>
            <th>Name</th>
            <th>Course</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($recentStudents)) { ?>
            <tr>
                <td><?php echo $row['full_name']; ?></td>
                <td>
                    <span class="course-badge">
                        <?php echo $row['course']; ?>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>

<!-- SYSTEM INFO -->
<div class="card">
    <h2>System Overview</h2>
    <p>
        IMBS Green Campus ,located in Gampaha,Sri Lanka, is a higher education institution 
        established in 2015 that offers affordable, industry-focused Diploma and Higher Diploma programs.
        It specializes in business management, IT,Psychology, and English,with partnerships 
        including  ABE (UK) and IIC university of Technology for degree pathways.
    </p>
</div>

</div>

</body>
</html>
