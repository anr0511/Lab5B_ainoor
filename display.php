<?php
// Database connection
$host = "localhost";
$user = "root"; 
$pass = "";    
$db = "lab5b"; 

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data
$query = "SELECT matric, name, role FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #2564b3;
            color: white;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        .logout-btn {
    text-align: center;
    margin-bottom: 20px;
}

.logout-btn a {
    padding: 10px 20px;
    background-color: #124396; 
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-size: 16px;
}

.logout-btn a:hover {
    background-color: #000000; 
}
    </style>
</head>
<body>
    <h2 style="text-align: center;">User Information</h2>
    <table>
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['matric']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['role']}</td>";
                    echo "<td>
                            <a href='update_form.php?matric={$row['matric']}'>Update</a> |
                            <a href='delete.php?matric={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="logout-btn">
    <a href="logout.php">Logout</a>
    </div>

</body>
</html>

<?php
$conn->close();
?>
