<?php
include_once "koneksi.php";
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));
        mysqli_query($conn, "UPDATE users SET otp='$otp', otp_expiry='$otp_expiry' WHERE id=" . $user['id']);

        // Simpan informasi user di session otp_user
        $_SESSION['otp_user'] = [
            'username' => $user['username'],
            'role' => $user['role'],
            'email' => $user['email']
        ];

        // Kirim OTP ke Email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'emailkamu@gmail.com'';
            $mail->Password = 'sandi_aplikasi_gmail';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('emailkamu@gmail.com'', '2FA System');
            $mail->addAddress($user['email'], $user['name']);
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Anda';
            $mail->Body    = "OTP Anda: <b>$otp</b><br>Berlaku selama 5 menit.";

            $mail->send();
            header("Location: verify_otp.php");
            exit;
        } catch (Exception $e) {
            echo "Email gagal dikirim: " . $mail->ErrorInfo;
        }
    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login dengan OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f0f0; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { max-width: 400px; width: 100%; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .card-body { padding: 2rem; }
    </style>
</head>
<body>
<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">Login</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required placeholder="Enter your username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required placeholder="Enter your password">
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>

            <div class="mt-3 text-muted text-center">
                Don't have an account? <a href="register.php">Sign Up</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
