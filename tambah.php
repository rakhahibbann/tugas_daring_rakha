<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"] ?? "";
    $email = $_POST["email"] ?? "";
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("INSERT INTO pengguna (nama, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $username, $password);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    }

    echo "Gagal menambahkan data: " . htmlspecialchars($conn->error);
}
?>
