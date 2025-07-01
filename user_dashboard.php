<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand" href="#">Welcome, <?= $_SESSION['username']; ?></a>
    <div class="ms-auto">
        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
</nav>

<div class="container my-5">
    <h3>Dashboard Pengguna</h3>
    <p>Halo <strong><?= $_SESSION['username']; ?></strong>, selamat datang di dashboard pengguna!</p>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Profil Saya</h5>
                    <p>Nama: <?= $_SESSION['username']; ?></p>
                    <a href="edit_profile.php" class="btn btn-sm btn-outline-primary">Edit Profil</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Riwayat Aktivitas</h5>
                    <p>Belum ada aktivitas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
