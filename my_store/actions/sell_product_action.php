<?php
include('../db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity > 0) {
            // Update product quantity
            $conn->query("UPDATE products SET quantity = quantity - $quantity WHERE id = $id");

            // Record sale
            $conn->query("INSERT INTO sales (product_id, quantity) VALUES ($id, $quantity)");
        }
    }

    header('Location: ../sell_product.php?status=success');
}
?>
