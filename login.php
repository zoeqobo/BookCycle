<?php
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include("db.php");

$error = "";

if(isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");

    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id']  = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];

        if($user['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookCycle</title>
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
<main style="max-width:600px; margin:50px auto;">
    <div class="container">
        <h1 style="text-align:center;">Login</h1>
        <br>
        <?php if($error): ?>
            <p style="color:red; text-align:center;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <br>
            <button type="submit" name="login">Login</button>
        </form>
        <br>
        <p style="text-align:center;"><strong>Don't have an account? <a href="register.php">Register here</a></strong></p>
    </div>
</main>
</body>
</html>