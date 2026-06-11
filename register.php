<?php
session_start();
include 'db.php';

if(isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "INSERT INTO users (username, email, password, role)
            VALUES ('$username', '$email', '$password', 'user')";

    if($conn->query($sql)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BookCycle</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <div class="header-inner">
        <a href="index.php" class="logo">
            <div class="logo-icon">📚</div>
            BookCycle
        </a>
    </div>
</header>
<main style="max-width:700px; margin:50px auto;">
    <div class="container">
        <h1>Create Account</h1>
        <?php if(isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Student Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <br>
            <button type="submit" name="register">Create Account</button>
        </form>
        <br>
        <p style="text-align:center;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</main>
</body>
</html>