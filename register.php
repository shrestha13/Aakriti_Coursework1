<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

include 'config.php'; // Ensure this file contains your MySQLi connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    // Bind parameters
    $stmt->bind_param("ss", $username, $password);

    // Execute the query
    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
