<?php
include_once "koneksi.php";
require 'vendor/autoload.php'; // Autoload PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if (!isset($_SESSION['otp_username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['otp_username'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Generate OTP baru
    $otp = rand(100000, 999999);
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    // Update OTP di database
    mysqli_query($conn, "UPDATE users SET otp='$otp', otp_expiry='$otp_expiry' WHERE username='$username'");

    // Kirim ulang OTP ke email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'emailkamu@gmail.com''; // Ganti
        $mail->Password = 'sandi_aplikasi_gmail';     // Ganti dengan App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('emailkamu@gmail.com', '2FA System');
        $mail->addAddress($user['email'], $user['name']);
        $mail->Subject = 'OTP Baru Anda';
        $mail->Body    = "OTP baru Anda adalah: $otp. Berlaku selama 5 menit.";

        $mail->send();

        echo "<script>
            alert('OTP baru berhasil dikirim ke email Anda!');
            window.location.href = 'verify_otp.php';
        </script>";
    } catch (Exception $e) {
        echo "Gagal mengirim ulang OTP. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<script>alert('User tidak ditemukan!'); window.location.href = 'login.php';</script>";
}
?>
