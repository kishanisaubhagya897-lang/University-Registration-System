<?php 
include "includes/auth.php"; 
include "includes/config.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Student</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="main">

<div class="card">

<h2>🎓 Student Registration Form</h2>
<p style="color:#64748b;margin-bottom:20px;">
Complete the form below to register a new student.
</p>

<form method="post" onsubmit="return validateForm()" class="form-grid">

    <!-- PERSONAL INFO -->
    <div class="section-title full-width">Personal Information</div>

    <div class="form-group">
        <label>Full Name</label>
        <input name="full_name" placeholder="Enter Full Name" required>
    </div>

    <div class="form-group">
        <label>NIC Number</label>
        <input id="nic" name="nic" placeholder="Enter NIC Number" required>
    </div>

    <div class="form-group">
        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>

    <!-- CONTACT INFO -->
    <div class="section-title full-width">Contact Information</div>

    <div class="form-group full-width">
        <label>Address</label>
        <textarea name="address" placeholder="Enter Address"></textarea>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input id="phone" name="phone" placeholder="Enter Phone Number">
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter Email">
    </div>

    <!-- ACADEMIC INFO -->
    <div class="section-title full-width">Academic Information</div>

    <div class="form-group full-width">
        <label>Course</label>
        <input name="course" placeholder="Enter Course Name">
    </div>

    <!-- BUTTONS -->
    <div class="form-group full-width button-group">
        <button type="submit" name="save">Register Student</button>
        <button type="reset" class="secondary-btn">Clear Form</button>
    </div>

</form>

<?php
if(isset($_POST['save'])){

    $nic = trim($_POST['nic']);
    $name = trim($_POST['full_name']);
    $gender = trim($_POST['gender']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    // 🔹 NIC Validation (exactly 12 characters)
    if(strlen($nic) != 12){
        echo "<div class='error'>NIC must be exactly 12 characters.</div>";
    }

    // 🔹 Phone Validation (exactly 10 digits)
    elseif(!preg_match('/^[0-9]{10}$/', $phone)){
        echo "<div class='error'>Phone number must be exactly 10 digits.</div>";
    }

    else {

        $nic = mysqli_real_escape_string($conn,$nic);
        $name = mysqli_real_escape_string($conn,$name);
        $gender = mysqli_real_escape_string($conn,$gender);
        $address = mysqli_real_escape_string($conn,$address);
        $phone = mysqli_real_escape_string($conn,$phone);
        $email = mysqli_real_escape_string($conn,$email);
        $course = mysqli_real_escape_string($conn,$course);

        mysqli_query($conn,"INSERT INTO students 
        (nic, full_name, gender, address, phone, email, course, created_at)
        VALUES ('$nic','$name','$gender','$address','$phone','$email','$course',NOW())");

        echo "<div class='success'>Student Registered Successfully 🎉</div>";
    }
}
?>

</div>
</div>
</body>
</html>
