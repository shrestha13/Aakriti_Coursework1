<?php
// Enable error reporting for debugging
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

// Database configuration
$host = 'localhost'; // Database server
$dbname = 'wellness_app';
$username = 'root';
$password = '';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch journal entries for the user (hardcoded user_id = 1 for now)
$user_id = 1; // Replace with dynamic user ID in the future
$sql = "SELECT id, entry, entry_date, title FROM journal_entries WHERE user_id = ? ORDER BY entry_date DESC";
$stmt = $conn->prepare($sql);

// Check if query preparation is successful
if ($stmt === false) {
    die("Error preparing query: " . $conn->error);  // Show error message if query fails
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any entries
if ($result->num_rows > 0) {
    echo "<h2>Your Journal Entries</h2>";
    echo "<ul style='list-style-type: none; padding: 0;'>";

    while ($row = $result->fetch_assoc()) {
        $entryId = $row['id']; // Changed from entry_id to id
        $title = htmlspecialchars($row['title']);
        $entry = htmlspecialchars($row['entry']);
        $entryDate = htmlspecialchars($row['entry_date']);

        echo "<li style='background: #fffafc; padding: 10px; margin-bottom: 10px; border-radius: 10px; border: 2px solid #ff80ab;'>";
        echo "<strong>Date:</strong> $entryDate<br>";
        echo "<a href='javascript:void(0);' onclick='showEntry($entryId)'>$title</a>"; // Title link
        echo "<div id='entry-$entryId' style='display: none; padding-top: 10px;'><strong>Entry:</strong> $entry</div>"; // Hidden entry content
        echo "</li>";
    }

    echo "</ul>";
} else {
    echo "<p>No journal entries found. Start writing!</p>";
}

$stmt->close();
$conn->close();
?>

<script>
  // Function to toggle the visibility of the journal content
  function showEntry(entryId) {
    var entry = document.getElementById('entry-' + entryId);
    // Check the current display status and toggle it
    if (entry.style.display === 'none' || entry.style.display === '') {
      entry.style.display = 'block'; // Show entry content
    } else {
      entry.style.display = 'none'; // Hide entry content
    }
  }
</script>
