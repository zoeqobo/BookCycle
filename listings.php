<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['delete'])) {
    $id  = mysqli_real_escape_string($conn, $_GET['delete']);
    $uid = $_SESSION['user_id'];
    mysqli_query($conn, "DELETE FROM listings WHERE listing_id = '$id' AND user_id = '$uid'");
    header("Location: listings.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM listings ORDER BY listing_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings - BookCycle</title>
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
            <a href="listings.php">Browse</a>
            <a href="create-listings.php">Sell a Book</a>
            <a href="dashboard.php">My Dashboard</a>
            <a href="logout.php">Log Out</a>
        </nav>
    </div>
</header>

<main style="max-width:1000px; margin:40px auto; padding:0 20px;">
    <h2>Available Textbooks</h2>
    <br>

    <?php if(mysqli_num_rows($result) == 0): ?>
        <p>No listings yet. <a href="create-listings.php">Be the first to sell a book!</a></p>
    <?php else: ?>
        <div class="listings-grid">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="listing-card">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                <p><strong>ISBN:</strong> <?php echo htmlspecialchars($row['isbn']); ?></p>
                <p><strong>Condition:</strong> <?php echo htmlspecialchars($row['book_condition']); ?></p>
                <p><strong>Price:</strong> R<?php echo number_format($row['price'], 2); ?></p>
                <?php if(!empty($row['description'])): ?>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                <?php endif; ?>
                <br>
                <?php if($row['user_id'] != $_SESSION['user_id']): ?>
                    <a href="payment.php?listing_id=<?php echo $row['listing_id']; ?>"
                       style="display:inline-block; padding:8px 16px; background:#2c5f2d; color:white; border-radius:6px; text-decoration:none; margin-right:6px;">
                        Buy Now
                    </a>
                <?php endif; ?>
                <?php if($row['user_id'] == $_SESSION['user_id']): ?>
                    <a href="listings.php?delete=<?php echo $row['listing_id']; ?>"
                       onclick="return confirm('Delete this listing?')"
                       class="btn-delete">Delete</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>