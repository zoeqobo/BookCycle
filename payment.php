<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get listing details
if(!isset($_GET['listing_id'])) {
    header("Location: listings.php");
    exit();
}

$listing_id = mysqli_real_escape_string($conn, $_GET['listing_id']);
$result = mysqli_query($conn, "SELECT * FROM listings WHERE listing_id = '$listing_id'");

if(mysqli_num_rows($result) == 0) {
    header("Location: listings.php");
    exit();
}

$listing = mysqli_fetch_assoc($result);

// Handle simulated payment submission
if(isset($_POST['pay'])) {
    // Simulate saving order to DB (would be real in production)
    $buyer_id = $_SESSION['user_id'];
    $amount   = $listing['price'];
    $ref      = 'BC-' . strtoupper(uniqid());

    // Redirect to success page with order ref
    header("Location: payment-success.php?ref=$ref&amount=$amount&title=" . urlencode($listing['title']));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout – BookCycle</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .checkout-wrap { max-width: 520px; margin: 50px auto; padding: 0 20px; }
        .payfast-card { background: white; border-radius: 14px; box-shadow: 0 4px 24px rgba(0,0,0,.10); overflow: hidden; }
        .payfast-header { background: #0079c1; padding: 22px 28px; display: flex; align-items: center; gap: 14px; }
        .payfast-header img { height: 32px; }
        .payfast-header span { color: white; font-weight: 700; font-size: 1.2rem; letter-spacing: .5px; }
        .payfast-body { padding: 28px; }
        .order-summary { background: #f4f8ff; border-radius: 8px; padding: 16px; margin-bottom: 24px; }
        .order-summary h4 { margin: 0 0 10px; font-size: .85rem; text-transform: uppercase; color: #666; letter-spacing: .5px; }
        .order-row { display: flex; justify-content: space-between; font-size: .95rem; margin: 6px 0; }
        .order-total { font-weight: 700; font-size: 1.1rem; border-top: 1px solid #dce6f5; padding-top: 10px; margin-top: 10px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: 5px; color: #333; }
        .form-group input { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 7px; font-size: .95rem; box-sizing: border-box; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .pay-btn { width: 100%; background: #0079c1; color: white; border: none; padding: 14px; border-radius: 8px; font-size: 1rem; font-weight: 700; cursor: pointer; margin-top: 8px; }
        .pay-btn:hover { background: #005fa3; }
        .secure-note { text-align: center; font-size: .78rem; color: #888; margin-top: 14px; }
        .sandbox-badge { background: #fff3cd; border: 1px solid #ffc107; color: #856404; font-size: .78rem; padding: 6px 12px; border-radius: 6px; text-align: center; margin-bottom: 20px; }
        .back-link { display: inline-block; margin-bottom: 18px; color: #0079c1; font-size: .9rem; text-decoration: none; }
    </style>
</head>
<body style="background:#f0f4f8;">

<div class="checkout-wrap">
    <a href="listings.php" class="back-link">← Back to listings</a>

    <div class="payfast-card">
        <div class="payfast-header">
            <span>🔒 PayFast Checkout</span>
        </div>
        <div class="payfast-body">

            <div class="sandbox-badge">⚠️ Sandbox / Test Mode — No real payments are processed</div>

            <div class="order-summary">
                <h4>Order Summary</h4>
                <div class="order-row">
                    <span><?php echo htmlspecialchars($listing['title']); ?></span>
                    <span>R<?php echo number_format($listing['price'], 2); ?></span>
                </div>
                <div class="order-row">
                    <span>Condition</span>
                    <span><?php echo htmlspecialchars($listing['book_condition']); ?></span>
                </div>
                <div class="order-row">
                    <span>Escrow fee</span>
                    <span>R0.00</span>
                </div>
                <div class="order-row order-total">
                    <span>Total</span>
                    <span>R<?php echo number_format($listing['price'], 2); ?></span>
                </div>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Cardholder Name</label>
                    <input type="text" placeholder="e.g. Zoë Qobo" required>
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" placeholder="4242 4242 4242 4242" maxlength="19" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="text" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" placeholder="123" maxlength="3" required>
                    </div>
                </div>
                <button type="submit" name="pay" class="pay-btn">
                    Pay R<?php echo number_format($listing['price'], 2); ?> Securely
                </button>
            </form>

            <p class="secure-note">🔐 256-bit SSL encrypted · Powered by PayFast · Funds held in escrow until delivery confirmed</p>
        </div>
    </div>
</div>

</body>
</html>