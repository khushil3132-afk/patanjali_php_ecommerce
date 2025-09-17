<?php
require_once "config.php";

// Fetch all products
function getProducts() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch a single product
function getProduct($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get current user
function getUser() {
    global $pdo;
    if (!isLoggedIn()) return null;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Add product to cart
function addToCart($productId, $qty = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $qty;
    } else {
        $_SESSION['cart'][$productId] = $qty;
    }
}

// Get cart items
function getCartItems() {
    $items = [];
    if (!isset($_SESSION['cart'])) return $items;

    foreach ($_SESSION['cart'] as $id => $qty) {
        $product = getProduct($id);
        if ($product) {
            $product['qty'] = $qty;
            $items[] = $product;
        }
    }
    return $items;
}

// Calculate cart total
function getCartTotal() {
    $items = getCartItems();
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'] * $item['qty'];
    }
    return $total;
}
?>
