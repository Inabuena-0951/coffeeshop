<?php
session_start();

if (isset($_POST['index'])) {
    $index = intval($_POST['index']);

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Reindex the cart array to avoid gaps in numeric indexes
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        echo json_encode(['status' => 'success', 'message' => 'Item removed from cart.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Item not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>