<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require "config.php";

$data = $conn->query("SELECT id, nama, email, username FROM pengguna ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Server Side</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container wide">
    <header class="topbar">
        <div>
            <h1>🌊 Dashboard</h1>
            <p>Selamat datang, <b><?= htmlspecialchars($_SESSION["nama"]) ?></b>!</p>
        </div>
        <a class="logout" href="logout.php">Logout</a>
    </header>

    <section class="card">
        <h2>Tambah Data Pengguna</h2>
        <form action="tambah.php" method="POST" class="grid-form">
            <input type="text" name="nama" placeholder="Nama lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">+ Tambah Data</button>
        </form>
    </section>

    <section class="card">
        <h2>Data Pengguna</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($data && $data->num_rows > 0): ?>
                    <?php while ($row = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= htmlspecialchars($row["nama"]) ?></td>
                        <td><?= htmlspecialchars($row["email"]) ?></td>
                        <td><?= htmlspecialchars($row["username"]) ?></td>
                        <td>
                            <a class="delete" href="hapus.php?id=<?= $row["id"] ?>"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada data.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
</body>
</html>
