<?php

session_start();
require 'db.php';

$error = "";

if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        !isset($_POST['csrf_token']) ||
        $_POST['csrf_token'] !== $_SESSION['csrf_token']
    ) {
        die("CSRF token validation failed");
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "select * from users where email = :email";
    $stmt = $conn->prepare($query);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user ['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email or password incorrect! Please try again";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body class="container mt-5">
    <h3 class="text">Login</h3>

    <?php if($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<=$_SESSION['csrf_token'] ?>">
        <input class="form-control mb-2" type="email" name="email" id="email" placeholder="Email">
        <input class="form-control mb-2" type="password" name="password" id="password" placeholder="Password">
        <button class="btn btn-success">Login</button>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"></script>
</body>
</html>