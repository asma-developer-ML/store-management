<?php
include('../db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];

    // Move uploaded file
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$image");

    // Insert product
    $sql = "INSERT INTO products (name, price, category_id, quantity, image) 
            VALUES ('$name', '$price', '$category_id', '$quantity', '$image')";
    $conn->query($sql);

    header('Location: ../add_product.php?status=success');
}
?>
