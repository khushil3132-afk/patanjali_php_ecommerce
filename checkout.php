<?php
require_once "functions.php";

if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$items = getCartItems();
$total = getCartTotal();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $pdo;
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$userId, $total]);
    $orderId = $pdo->lastInsertId();

    foreach ($items as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $item['id'], $item['qty'], $item['price']]);
    }

    $_SESSION['cart'] = [];
    header("Location: order_success.php?id=$orderId");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Patanjali Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Checkout</h1>
<p>Total: ₹<?php echo $total; ?></p>
<form method="post">
    <button type="submit">Place Order</button>
</form>
</body>
</html>
