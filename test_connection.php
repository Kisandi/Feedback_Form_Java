<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'moviebookingdb';

// Attempt connection
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    echo 'Connection successful!';
}

$conn->close();
?>
