<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c8fcfb ;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #7cc6d1;
            padding:50px;
            border-radius: 7px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }

        .form-container h2 {
            color: #white;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .form-container label {
            display: block;
            text-align: left;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-container input,
        .form-container select {
            width: 300px;
            padding: 10px;
            margin-bottom: 15px;
            margin-right:16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-container input[type="submit"] {
            background-color: #5bc0de;
            color: black;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .form-container input[type="submit"]:hover {
            background-color: #5de3cf;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Register Your Account</h2>
        <form action="insert.php" method="post">
            <label for="matric">Matric:</label>
            <input type="text" name="matric" id="matric" required>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="">Please select</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select>

            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</body>

</html>
