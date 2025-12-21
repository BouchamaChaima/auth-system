<?php

require 'db.php';

$email = "admin@gmail.fr";
$password = password_hash("123456", PASSWORD_DEFAULT);

$query = "insert into users (email, password) values (:email, :password)";
$stmt = $conn->prepare($query);
$stmt->execute(
    [
        ':email' => $email,
        ':password' => $password
    ]
    );

    echo "User created";

?>