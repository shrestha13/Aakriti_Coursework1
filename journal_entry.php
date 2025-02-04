<?php
// Enable error reporting for debugging
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

// Database configuration
$host = 'localhost';
$dbname = 'wellness_app';
$username = 'root';
$password = '';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $entry = $_POST['entry'];
    $user_id = 1; // Use a hardcoded user ID for now

    // Validate data
    if (empty($title) || empty($entry)) {
        echo "Title and entry are required.";
        exit;
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO journal_entries (user_id, title, entry, entry_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $user_id, $title, $entry);

    if ($stmt->execute()) {
        echo "Entry saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
