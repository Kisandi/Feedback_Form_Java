<?php
// Database connection
$host = 'localhost';
$user = 'root'; // Use your DB username
$password = ''; // Use your DB password
$database = 'moviebookingdb'; // Use your DB name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Validate input data
$name = isset($data['name']) ? $conn->real_escape_string($data['name']) : null;
$movieFeedback = isset($data['movieFeedback']) ? $conn->real_escape_string($data['movieFeedback']) : null;
$theaterFeedback = isset($data['theaterFeedback']) ? $conn->real_escape_string($data['theaterFeedback']) : null;

// Check if the necessary fields are provided
if (!$movieFeedback || !$theaterFeedback) {
    echo "Error: Missing required fields!";
    exit();
}

// Prepare SQL query to insert feedback
$stmt = $conn->prepare("INSERT INTO feedback (Name, Feed_movie, Feed_theather) VALUES (?, ?, ?)");
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$stmt->bind_param("sss", $name, $movieFeedback, $theaterFeedback);

// Check if the query executed successfully
if ($stmt->execute()) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error executing query: " . $stmt->error; // Output error message if any
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
