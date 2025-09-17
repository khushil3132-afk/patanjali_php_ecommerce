<?php
require_once "functions.php";
if (!isset($_GET['id'])) die("Invalid order");
$orderId = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>🎉 Order Placed Successfully!</h1>
<p>Your order ID is <strong>#<?php echo $orderId; ?></strong></p>
<a href="my_orders.php">View My Orders</a>
<a href="index.php">Continue Shopping</a>
</body>
</html>
