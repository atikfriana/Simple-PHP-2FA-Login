<?php
include_once "koneksi.php";
session_start();

// Cek apakah session otp_user ada
if (!isset($_SESSION['otp_user'])) {
    // Jika tidak ada, arahkan kembali ke halaman login
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_input = $_POST['otp'];
    $username = mysqli_real_escape_string($conn, $_SESSION['otp_user']['username']);  // Sesuaikan dengan session yang disimpan

    // Ambil data user dari database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && $user['otp'] == $otp_input && strtotime($user['otp_expiry']) >= time()) {
        // Login berhasil
        unset($_SESSION['otp_user']);  // Kosongkan session otp_user
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Kosongkan OTP di database setelah login sukses
        mysqli_query($conn, "UPDATE users SET otp=NULL, otp_expiry=NULL WHERE username='$username'");

        // Arahkan sesuai dengan role user
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit;
    } else {
        echo "<script>alert('OTP salah atau sudah kadaluarsa');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef1f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            border-radius: 8px;
        }
        .resend-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="card">
    <h4 class="text-center mb-4">Verifikasi OTP</h4>

    <!-- Pastikan session otp_user ada sebelum menampilkan info -->
    <?php if (isset($_SESSION['otp_user'])): ?>
        <div class="alert alert-info">
            OTP telah dikirim ke email <b><?= $_SESSION['otp_user']['email'] ?></b>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label for="otp" class="form-label">Masukkan OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required placeholder="Contoh: 123456">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Verifikasi</button>
        </div>
        <a href="resend_otp.php" class="resend-link">Kirim ulang OTP</a>
