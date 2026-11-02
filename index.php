<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "config.php";

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, nama, username, password FROM pengguna WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["nama"] = $user["nama"];
            $_SESSION["username"] = $user["username"];

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = "Username atau password salah!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Server Side</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container login-box">
    <h1>🌊 Server Side</h1>
    <p class="subtitle">Login Pemrograman Web - BAB 6</p>

    <?php if ($error): ?>
        <div class="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Masuk</button>
    </form>

    <div class="demo">
        <b>Login demo</b><br>
        Username: admin<br>
        Password: admin123
    </div>
</div>
</body>
</html>
