<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "lab5b";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $query = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No user found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $role = $_POST['role'];

    
    $query = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $role, $matric);

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user.";
    }

    $stmt->close();

    // link to display user page
    header("Location: display.php"); 
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            top: -50px; 
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .error {
            color: red;
            text-align: center;
        }

        input[type="text"], 
        select {
            width: 100%; 
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; 
        }

        input[type="submit"] {
            background: linear-gradient(to right, #6dcff6, #2aa1d8);
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            border-radius: 25px;
            text-align: center;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(to right, #2aa1d8, #007bb5);
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="">Please select</option>
                <option value="lecturer" <?php echo ($row['role'] == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
                <option value="student" <?php echo ($row['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
            </select>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
