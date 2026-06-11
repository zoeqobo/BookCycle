<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id  = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role     = $_SESSION['role'] ?? 'user';

if(isset($_GET['delete'])) {
    $del_id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM listings WHERE listing_id = '$del_id' AND user_id = '$user_id'");
    header("Location: dashboard.php");
    exit();
}

$listings = mysqli_query($conn, "SELECT * FROM listings WHERE user_id = '$user_id' ORDER BY listing_id DESC");
$listing_count = mysqli_num_rows($listings);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - BookCycle</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .dashboard-wrapper { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .dash-welcome { background: #2c5f2d; color: white; border-radius: 12px; padding: 28px 32px; margin-bottom: 32px; display: flex; justify-content: space-between; align-items: center; }
        .dash-welcome h2 { margin: 0 0 6px; font-size: 1.6rem; }
        .dash-welcome p { margin: 0; opacity: .85; }
        .dash-stats { display: flex; gap: 16px; margin-bottom: 32px; }
        .dash-stat { flex: 1; background: #f8f8f6; border-radius: 10px; padding: 20px; text-align: center; border: 1px solid #e0e0d8; }
        .dash-stat .num { font-size: 2rem; font-weight: 700; color: #2c5f2d; }
        .dash-stat .label { font-size: .85rem; color: #666; margin-top: 4px; }
        .dash-section-title { font-size: 1.2rem; font-weight: 600; margin-bottom: 16px; border-bottom: 2px solid #e0e0d8; padding-bottom: 8px; }
        .my-listings-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .my-listing-card { background: white; border: 1px solid #e0e0d8; border-radius: 10px; padding: 18px; }
        .my-listing-card h3 { margin: 0 0 10px; font-size: 1rem; }
        .my-listing-card p { margin: 4px 0; font-size: .88rem; color: #555; }
        .card-actions { margin-top: 14px; }
        .btn-delete-sm { background: #c94f1e; color: white; border: none; padding: 6px 14px; border-radius: 6px; cursor: pointer; font-size: .85rem; text-decoration: none; }
        .no-listings { text-align: center; padding: 48px; color: #888; }
        .no-listings a { color: #2c5f2d; font-weight: 600; }
        .admin-link { background: #c94f1e; color: white !important; padding: 8px 16px; border-radius: 8px; font-size: .9rem; text-decoration: none; }
    </style>
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
            <a href="create-listings.php">Sell a Book</a>
            <a href="dashboard.php" class="active">My Dashboard</a>
            <?php if($role === 'admin'): ?>
                <a href="admin.php" class="admin-link">⚙️ Admin Panel</a>
            <?php endif; ?>
        </nav>
        <div class="header-actions">
            <span style="font-size:.9rem; color:#666;">Hi, <?php echo htmlspecialchars($username); ?></span>
            <a href="logout.php" class="btn btn-ghost">Log Out</a>
        </div>
    </div>
</header>

<div class="dashboard-wrapper">
    <div class="dash-welcome">
        <div>
            <h2>Welcome back, <?php echo htmlspecialchars($username); ?>! 👋</h2>
            <p>Manage your textbook listings and account settings here.</p>
        </div>
        <?php if($role === 'admin'): ?>
            <a href="admin.php" class="admin-link">⚙️ Admin Panel</a>
        <?php endif; ?>
    </div>

    <div class="dash-stats">
        <div class="dash-stat"><div class="num"><?php echo $listing_count; ?></div><div class="label">My Listings</div></div>
        <div class="dash-stat"><div class="num"><?php echo ucfirst($role); ?></div><div class="label">Account Role</div></div>
        <div class="dash-stat"><div class="num">0</div><div class="label">Messages</div></div>
        <div class="dash-stat"><div class="num">0</div><div class="label">Orders</div></div>
    </div>

    <div class="dash-section-title">📚 My Listings</div>

    <?php if($listing_count === 0): ?>
        <div class="no-listings">
            <p style="font-size:2rem;">📭</p>
            <p>You haven't listed any books yet.</p>
            <a href="create-listings.php">+ List your first textbook</a>
        </div>
    <?php else: ?>
        <div class="my-listings-grid">
            <?php
            $listings = mysqli_query($conn, "SELECT * FROM listings WHERE user_id = '$user_id' ORDER BY listing_id DESC");
            while($row = mysqli_fetch_assoc($listings)): ?>
            <div class="my-listing-card">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                <p><strong>Price:</strong> R<?php echo number_format($row['price'], 2); ?></p>
                <p><strong>Condition:</strong> <?php echo htmlspecialchars($row['book_condition']); ?></p>
                <div class="card-actions">
                    <a href="dashboard.php?delete=<?php echo $row['listing_id']; ?>"
                       onclick="return confirm('Delete this listing?')"
                       class="btn-delete-sm">Delete</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>