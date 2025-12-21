<?php

$host = "localhost";
$db = "auth_db";
$user = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Failed! Something went wrong");
}

?>