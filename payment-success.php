<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$ref    = isset($_GET['ref'])    ? htmlspecialchars($_GET['ref'])            : 'BC-UNKNOWN';
$amount = isset($_GET['amount']) ? number_format((float)$_GET['amount'], 2) : '0.00';
$title  = isset($_GET['title'])  ? htmlspecialchars(urldecode($_GET['title'])) : 'Textbook';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful – BookCycle</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .success-wrap { max-width: 500px; margin: 70px auto; padding: 0 20px; text-align: center; }
        .success-card { background: white; border-radius: 14px; box-shadow: 0 4px 24px rgba(0,0,0,.10); padding: 48px 36px; }
        .success-icon { font-size: 4rem; margin-bottom: 16px; }
        .success-card h1 { color: #2c5f2d; margin: 0 0 10px; font-size: 1.7rem; }
        .success-card p { color: #555; margin: 0 0 24px; }
        .ref-box { background: #f4f8f4; border: 1px dashed #2c5f2d; border-radius: 8px; padding: 14px; margin: 20px 0; font-family: monospace; font-size: 1rem; color: #2c5f2d; }
        .detail-row { display: flex; justify-content: space-between; font-size: .92rem; padding: 8px 0; border-bottom: 1px solid #eee; }
        .detail-row:last-child { border-bottom: none; font-weight: 700; }
        .escrow-note { background: #fff8e1; border-radius: 8px; padding: 14px; font-size: .85rem; color: #7a5c00; margin: 20px 0; }
        .btn-home { display: inline-block; margin-top: 24px; background: #2c5f2d; color: white; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body style="background:#f0f4f8;">

<div class="success-wrap">
    <div class="success-card">
        <div class="success-icon">✅</div>
        <h1>Payment Successful!</h1>
        <p>Your payment has been received and is held securely in escrow.</p>

        <div class="ref-box">
            Reference: <?php echo $ref; ?>
        </div>

        <div class="detail-row"><span>Book</span><span><?php echo $title; ?></span></div>
        <div class="detail-row"><span>Amount Paid</span><span>R<?php echo $amount; ?></span></div>
        <div class="detail-row"><span>Status</span><span>🟡 Held in Escrow</span></div>

        <div class="escrow-note">
            🔒 <strong>Escrow Protection:</strong> Your R<?php echo $amount; ?> is held securely. Funds will only be released to the seller once you confirm you've received the book in the expected condition.
        </div>

        <a href="dashboard.php" class="btn-home">Go to My Dashboard</a>
    </div>
</div>

</body>
</html>