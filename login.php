<?php
session_start();
if(isset($_POST['login'])){
    if($_POST['username']=="admin" && $_POST['password']=="admin123"){
        $_SESSION['admin']=true;
        header("Location: dashboard.php");
    } else {
        $error="Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="card" style="width:350px;margin:120px auto;">
<h2>University Admin Login</h2>
<form method="post">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
</div>

</body>
</html>
