<?php include('db_connection.php'); ?>

<h2>Sell Product</h2>
<form action="actions/sell_product_action.php" method="POST">
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Available Stock</th>
            <th>Sell Quantity</th>
        </tr>
        <?php
        $products = $conn->query("SELECT * FROM products");
        while ($prod = $products->fetch_assoc()) {
            echo "<tr>
                <td>{$prod['name']}</td>
                <td>{$prod['quantity']}</td>
                <td><input type='number' name='quantity[{$prod['id']}]' min='0' max='{$prod['quantity']}'></td>
            </tr>";
        }
        ?>
    </table>
    <button type="submit">Sell</button>
</form>
<a href="index.php">Back</a>
