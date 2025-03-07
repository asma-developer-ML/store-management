<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title> 
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>List of Registered Users</h2>

    <table id="userTable">
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>email</th>
            </tr>
        </thead>
        <tbody>
           
            <?php
           
            

           
            $host = 'localhost'; 
            $username = 'root';
            $password = '';
            $dbname = 'user_system';

            
            $conn = new mysqli($host, $username, $password, $dbname);

           
            if($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }

            
            $result_to_execute_query = $conn->query("SELECT id, username, email FROM users");

            // Check if any rows were returned
            if ($result_to_execute_query->num_rows > 0) {
                // Fetch all rows and insert them into the table
                $rows = $result_to_execute_query->fetch_all(MYSQLI_ASSOC);
                
                foreach($rows as $row){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
        </tbody>
        
    </table>
</html>