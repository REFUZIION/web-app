<?php
require_once('auth/dbconfig.php');
    $login_failed = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Login success
                setcookie("username", $user['username'], time() + (86400 * 30), "/");
                header("Location: user/home.php");
            } else {
                // Login failed
                $login_failed = true;
            }
        } else {
            // Login failed
            $login_failed = true;
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="main">
        <form method="post">
        <div class="banner">
            <?php if($login_failed): ?>
                <div class="error-banner">
                    <p>Incorrect username or password.<br>Please try again.</p>
                </div>
            <?php endif; ?>
        </div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Log in">
            <p>Dont have an account yet? <a href="register.html">register</a> here</p>
        </form>
    </div>
</body>
</html>