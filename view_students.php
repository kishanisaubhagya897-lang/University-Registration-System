<?php include "includes/auth.php"; ?>
<?php include "includes/config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="main">

<div class="card">

<h2>Student Records</h2>

<div class="search-section">
    <form method="get" class="search-form">
        
        <div class="search-input-wrapper">
            <input type="text" name="search"
                   placeholder="Search by NIC"
                   value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>

        <button type="submit" class="search-btn">
            🔍 Search
        </button>

    </form>
</div>


<?php
$where = "";
if (!empty($_GET['search'])) {
    $search = $_GET['search'];
    $where = "WHERE nic LIKE '%$search%'";
}

$result = mysqli_query($conn, "SELECT * FROM students $where");
$count = mysqli_num_rows($result);
?>

<!-- TOTAL COUNT -->
<div class="record-info">
    <p>Total Records Found: <strong><?php echo $count; ?></strong></p>
</div>

<table class="styled-table">
<tr>
    <th>NIC</th>
    <th>Name</th>
    <th>Course</th>
    <th>Action</th>
</tr>

<?php
if($count > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['nic']}</td>
            <td>{$row['full_name']}</td>
            <td><span class='course-badge'>{$row['course']}</span></td>
            <td>
                <a class='btn-edit' href='edit_student.php?nic={$row['nic']}'>Edit</a>
                <a class='btn-delete' href='delete_student.php?nic={$row['nic']}'
                onclick='return confirm(\"Are you sure you want to delete?\")'>
                Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='no-record'>No student records found.</td></tr>";
}
?>

</table>

</div>
</div>

</body>
</html>
