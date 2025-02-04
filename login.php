<?php
session_start();
include 'config.php';

/*error_reporting(E_ALL);
ini_set('display_errors', 1); // Show errors for debugging*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST); // Debugging output

    // Check if email and password are provided
    if (isset($_POST['email'], $_POST['password']) && !empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id; 
                session_regenerate_id(true); // Prevent session fixation attacks
                //echo "Login successful! User ID: " . $_SESSION['user_id']; // Debugging session
                header("Location: dashboard.html");
                exit;
            } else {
                echo "❌ Invalid email or password.";
            }
        } else {
            echo "❌ Invalid email or password.";
        }
    } else {
        echo "⚠️ Please enter both email and password.";
    }
}
?>
