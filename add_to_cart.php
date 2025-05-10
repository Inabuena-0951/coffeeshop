<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['item']) && isset($_POST['price'])) {
    $item = $_POST['item'];
    $price = floatval($_POST['price']);
    $found = false;

    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['item'] === $item) {
            $cartItem['quantity'] = isset($cartItem['quantity']) ? $cartItem['quantity'] + 1 : 2;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = ['item' => $item, 'price' => $price, 'quantity' => 1];
    }

    echo json_encode(['status' => 'success', 'message' => 'Item added']);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit;
}