<?php
// check if the cookie is set
if(isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    echo "Welcome, $username!";
} else {
    // redirect user to the login page
    header("Location: login.php");
}
?>
<br>
<a href="../auth/logout.php">Logout</a>