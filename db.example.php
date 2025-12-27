<?php

$host = "localhost";
$db   = "database_name";
$user = "db_user";
$pass = "db_password";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed");
}

?>