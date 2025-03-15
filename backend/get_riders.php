<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow cross-origin requests (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Database connection details
$host = 'localhost';
$db   = 'riders_adda';
$user = 'root';  // Change if using a different MySQL user
$pass = '';      // Change if you have a password

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection error
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Query to get all riders
$sql = "SELECT id, name, email, phone FROM riders";  // Fetch only needed columns
$result = $conn->query($sql);

$riders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $riders[] = $row;
    }
    echo json_encode($riders);
} else {
    echo json_encode(["message" => "No riders found"]);
}

// Close connection
$conn->close();
?>
