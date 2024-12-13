<?php
session_start(); // Start the session


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: display.php"); 
    exit;
}

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root"; 
    $password = "";     
    $dbname = "lab5b"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT matric, password FROM users WHERE matric = ?");
    $stmt->bind_param("s", $_POST['matric']);
    $stmt->execute();
    $stmt->store_result();

 
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($matric, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($_POST['password'], $hashed_password)) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['matric'] = $matric; 
            header("location: display.php"); 
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that matric.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
input[type="password"] {
    width: 370px; 
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
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
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <input type="text" name="matric" placeholder="Matric Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register_form.php">Register here</a></p>
        </div>
    </div>
</body>
</html>