<?php
// Connect to database
require_once('dbconfig.php');

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    // Set parameters and execute
    $username = mysqli_real_escape_string($conn, $user);
    $password = mysqli_real_escape_string($conn, $pass_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Login successful
        echo "true";
    } else {
        // Login unsuccessful
        echo "false";
    }
    $stmt->close();
}