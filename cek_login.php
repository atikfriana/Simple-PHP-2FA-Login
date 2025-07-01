<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        // Simulasi OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expiry'] = time() + 300; // 5 menit
        $_SESSION['username'] = $username;

        // Simulasi "pengiriman OTP" lewat alert
        echo "<script>
            alert('OTP kamu adalah: $otp');
            window.location.href = 'verify_otp.php';
        </script>";
    } else {
        echo "<script>alert('Login gagal'); window.location.href='login.php';</script>";
    }
}
?>
