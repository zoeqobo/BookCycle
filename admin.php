<?php
session_start();
include("db.php");

// Check if user is logged in and is admin
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Simple RBAC - check if admin
$user_id = $_SESSION['user_id'];
$check_admin = mysqli_query($conn, "SELECT role FROM users WHERE user_id = '$user_id'");
$user_role = mysqli_fetch_assoc($check_admin);

if(!isset($user_role['role']) || $user_role['role'] != 'admin') {
    echo "Access denied. Admin only.";
    exit();
}

// Handle user role updates (UPDATE)
if(isset($_POST['update_role'])) {
    $target_user = $_POST['user_id'];
    $new_role = $_POST['role'];
    mysqli_query($conn, "UPDATE users SET role = '$new_role' WHERE user_id = '$target_user'");
    header("Location: admin.php");
    exit();
}

// Handle delete user (DELETE)
if(isset($_GET['delete_user'])) {
    $target_user = $_GET['delete_user'];
    mysqli_query($conn, "DELETE FROM users WHERE user_id = '$target_user'");
    header("Location: admin.php");
    exit();
}
// Handle delete listing (DELETE)
if(isset($_GET['delete_listing'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete_listing']);
    mysqli_query($conn, "DELETE FROM listings WHERE listing_id = '$id'");
    header("Location: admin.php");
    exit();
}

// Fetch all users (READ)
$users = mysqli_query($conn, "SELECT * FROM users");
$listings = mysqli_query($conn, "SELECT * FROM listings");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - BookCycle</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .admin-container { max-width: 1200px; margin: 40px auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #2c5f2d; color: white; }
        .btn { padding: 5px 10px; margin: 2px; border: none; cursor: pointer; }
        .btn-delete { background: #c94f1e; color: white; }
        .btn-update { background: #2c5f2d; color: white; }
        select { padding: 5px; }
    </style>
</head>
<body>
<header>
    <div class="header-inner">
        <a href="index.php" class="logo">📚 BookCycle Admin</a>
        <nav>
            <a href="index.php">Home</a>
            <a href="listings.php">Browse</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</header>

<div class="admin-container">
    <h1>Administrator Dashboard</h1>
    
    <h2>📋 Role-Based Access Control (RBAC)</h2>
    <p>Manage user roles - Admin can promote/demote users</p>
    
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Current Role</th>
            <th>Update Role</th>
            <th>Delete User</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($users)): ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo isset($row['role']) ? $row['role'] : 'user'; ?></td>
            <td>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <select name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <button type="submit" name="update_role" class="btn btn-update">Update</button>
                </form>
            </td>
            <td>
                <a href="admin.php?delete_user=<?php echo $row['user_id']; ?>" 
                   onclick="return confirm('Delete this user?')" 
                   class="btn btn-delete">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>📚 Manage Textbook Listings</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th>Condition</th>
            <th>Delete</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($listings)): ?>
        <tr>
            <td><?php echo $row['listing_id']; ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td>R<?php echo $row['price']; ?></td>
            <td><?php echo $row['book_condition']; ?></td>
            <td>
                <a href="admin.php?delete_listing=<?php echo $row['listing_id']; ?>" 
                   onclick="return confirm('Delete this listing?')" 
                   class="btn btn-delete">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
