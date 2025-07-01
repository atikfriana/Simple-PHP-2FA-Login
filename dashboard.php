<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            background-color: white;
        }
        .btn-logout {
            border-radius: 8px;
            margin-top: 20px;
        }
        h2 span {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Selamat datang, <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>! 👋</h2>
    <p class="mt-3">Kamu berhasil login menggunakan sistem <strong>OTP (One Time Password)</strong>.</p>
    
    <a href="logout.php" class="btn btn-danger btn-logout">Logout</a>
</div>

</body>
</html>
