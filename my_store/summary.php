<?php include('db_connection.php'); ?>

<h2>Sales Summary</h2>
<table border="1">
    <tr>
        <th>Image of the product</th>
        <th>Product</th>
        <th>Total Sold</th>
        <th>Total Revenue</th>
    </tr>
    <?php
    $sql = "SELECT p.name, p.image,  SUM(s.quantity) AS total_sold, SUM(s.quantity * p.price) AS total_revenue
            FROM sales s
            JOIN products p ON s.product_id = p.id
            GROUP BY p.id";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        
        echo "<tr>
            <td><img src='./uploads/{$row['image']}' alt='{$row['name']}' width='100'></td>
            <td>{$row['name']}</td>
            <td>{$row['total_sold']}</td>
            <td>{$row['total_revenue']}</td>
        </tr>";
    }
   
    
    ?>
</table>

<a href="index.php">Back</a>
