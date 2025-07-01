<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-box {
            border-radius: 12px;
            padding: 20px;
            color: white;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <div class="ms-auto text-white">Halo, <?= $_SESSION['username']; ?> | <a href="logout.php" class="text-danger ms-3">Logout</a></div>
</nav>

<div class="container my-5">
    <h3>Dashboard Admin</h3>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="dashboard-box bg-primary">
                <h5>Total Users</h5>
                <p>28</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-box bg-success">
                <h5>Data Reports</h5>
                <p>04</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-box bg-warning">
                <h5>Active Sessions</h5>
                <p>06</p>
            </div>
        </div>
    </div>
    <hr>
    <a href="manage_users.php" class="btn btn-outline-primary">Kelola Pengguna</a>
    <a href="laporan.php" class="btn btn-outline-secondary">Lihat Laporan</a>
</div>
</body>
</html>
