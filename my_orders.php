<?php
require_once "functions.php";

if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user = getUser();
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user['id']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Orders - Patanjali Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>My Orders</h1>
<?php if (empty($orders)): ?>
    <p>No orders found.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Order ID</th><th>Total</th><th>Date</th>
        </tr>
        <?php foreach ($orders as $o): ?>
        <tr>
            <td>#<?php echo $o['id']; ?></td>
            <td>₹<?php echo $o['total']; ?></td>
            <td><?php echo $o['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<a href="index.php">← Back to Shopping</a>
</body>
</html>
