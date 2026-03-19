<?php
include "includes/auth.php";
include "includes/config.php";

$nic = $_GET['nic'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM students WHERE nic='$nic'")
);

if (isset($_POST['update'])) {

    mysqli_query($conn, "
        UPDATE students SET
        full_name='{$_POST['full_name']}',
        gender='{$_POST['gender']}',
        address='{$_POST['address']}',
        phone='{$_POST['phone']}',
        email='{$_POST['email']}',
        course='{$_POST['course']}'
        WHERE nic='$nic'
    ");

    header("Location: view_students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="main">

    <div class="card">

        <h2>Edit Student Details</h2>
        <p style="color:#64748b;margin-bottom:15px;">
            Modify student information and update records securely.
        </p>

        <form method="post" class="form-grid">

            <div class="form-group">
                <label>Full Name</label>
                <input name="full_name" 
                       value="<?php echo $data['full_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>NIC Number</label>
                <input name="nic" 
                       value="<?php echo $data['nic']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Male" 
                        <?php if($data['gender']=="Male") echo "selected"; ?>>
                        Male
                    </option>
                    <option value="Female" 
                        <?php if($data['gender']=="Female") echo "selected"; ?>>
                        Female
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input name="phone" 
                       value="<?php echo $data['phone']; ?>">
            </div>

            <div class="form-group full-width">
                <label>Address</label>
                <textarea name="address"><?php echo $data['address']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" 
                       value="<?php echo $data['email']; ?>">
            </div>

            <div class="form-group">
                <label>Course</label>
                <input name="course" 
                       value="<?php echo $data['course']; ?>">
            </div>

            <div class="form-group full-width">
                <button name="update">Update Student</button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
