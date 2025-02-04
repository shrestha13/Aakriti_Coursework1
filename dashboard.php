<?php
session_start();

/*// Debug: Check if session is set
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in. Redirecting to login.");
}*/

// Include database configuration
include 'config.php';

// Debug: Show posted data
//error_log("POST Data: " . print_r($_POST, true));

// Check if the form was submitted properly
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mood']) && !empty($_POST['mood'])) {
        $mood = $_POST['mood'];
        $user_id = $_SESSION['user_id'];
        $entry_date = date('Y-m-d H:i:s');

        // Debug: Confirm values before inserting
        //error_log("Received Mood: $mood from User ID: $user_id");

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO mood_entries (user_id, mood, entry_date) VALUES (?, ?, ?)");

        if ($stmt === false) {
            die("MySQL prepare error: " . $conn->error);
        }

        $stmt->bind_param("iss", $user_id, $mood, $entry_date);

        if ($stmt->execute()) {
            error_log("Mood entry recorded successfully.");
            //echo "Mood recorded successfully!";
           header("Location: dashboard.html?mood=" . urlencode($mood));
            exit;
        } else {
            die("SQL Error: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Error: Mood not received.");
    }
} else {
    die("Error: Invalid request method.");
}

$conn->close();
?>
