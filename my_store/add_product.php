<?php include('db_connection.php'); ?>

<h2>Add Product</h2>
<form action="actions/add_product_action.php" method="POST" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>
    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" required><br><br>
    <label>Category:</label><br>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php
        $categories = $conn->query("SELECT * FROM categories");
        while ($cat = $categories->fetch_assoc()) {
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
        }
        ?>
    </select><br><br>
    <label>Quantity:</label><br>
    <input type="number" name="quantity" required><br><br>
    <label>Image:</label><br>
    <input type="file" name="image" required><br><br>
    <button type="submit">Add Product</button>
</form>
<a href="index.php">Back</a>
