<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['create_listing'])) {
    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $author      = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn        = mysqli_real_escape_string($conn, $_POST['isbn']);
    $price       = mysqli_real_escape_string($conn, $_POST['price']);
    $condition   = mysqli_real_escape_string($conn, $_POST['book_condition']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $user_id     = $_SESSION['user_id'];

    $sql = "INSERT INTO listings (title, author, isbn, price, book_condition, description, user_id)
            VALUES ('$title', '$author', '$isbn', '$price', '$condition', '$description', '$user_id')";

    if(mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error creating listing.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Listing - BookCycle</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <div class="header-inner">
        <a href="index.php" class="logo">
            <div class="logo-icon">📚</div>
            BookCycle
        </a>
        <nav>
            <a href="index.php">Browse</a>
            <a href="listings.php">Listings</a>
            <a href="dashboard.php">My Dashboard</a>
            <a href="logout.php">Log Out</a>
        </nav>
    </div>
</header>
<main style="max-width:800px; margin:50px auto;">
    <h2>Sell a Textbook</h2>
    <br>
    <?php if(isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>Book Title:</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Author:</label>
            <input type="text" name="author" required>
        </div>
        <div class="form-group">
            <label>ISBN:</label>
            <input type="text" name="isbn">
        </div>
        <div class="form-group">
            <label>Condition:</label>
            <select name="book_condition" required>
                <option value="">Select Condition</option>
                <option value="New">New</option>
                <option value="Good">Good</option>
                <option value="Fair">Fair</option>
            </select>
        </div>
        <div class="form-group">
            <label>Price (ZAR):</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" rows="4"></textarea>
        </div>
        <br>
        <button type="submit" name="create_listing">Create Listing</button>
    </form>
</main>
</body>
</html>