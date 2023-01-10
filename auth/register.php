<?php
require_once('dbconfig.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
    isset($_POST['username']) && 
    isset($_POST['password']) && 
    isset($_POST['password_confirm'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);

    if (username_exists($username, $conn)) {
        die("username already exists");
        header('Refresh: 3; ../register.html');
    }

    if ($password !== $password_confirm) {
        die("password fields do not match");
        header('Refresh: 3; ../register.html');
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
    // redirect user to the login page
    header('Location: ../index.php');
}

$conn->close();

// Function to check if username exists
function username_exists($username, $conn) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->num_rows > 0;
}
