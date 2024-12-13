<?php
include 'Database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create instance of User class
$user = new User($db);

// Register using POST data
$user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);

// Close the connection
$db->close();