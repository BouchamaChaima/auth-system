<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

if (
    !isset($_POST['csrf_token']) ||
    $_POST['csrf_token'] !== $_SESSION['csrf_token']
) {
    die("CSRF validation failed");
}

session_destroy();
header("Location: login.php");
?>