<?php
if (isset($_COOKIE['username'])) {
    // Delete the cookie
    setcookie("username", "", time() - 3600, "/");
}

// Redirect to login page
header("Location: ../index.php");

?>