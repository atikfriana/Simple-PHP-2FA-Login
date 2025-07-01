<?php
include_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $email    = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $role     = trim(mysqli_real_escape_string($conn, $_POST['role']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // Cek apakah username atau email sudah ada
    $checkUsername = mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM users WHERE username = '$username'"));
    $checkEmail    = mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM users WHERE email = '$email'"));

    if ($checkUsername == 0 && $checkEmail == 0) {
        // Insert data (id akan otomatis ditambahkan karena AUTO_INCREMENT)
        $query = "INSERT INTO users (name, username, email, password, role) 
                  VALUES ('$name', '$username', '$email', '$password', '$role')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                alert('Registration Successful');
                window.location.href = 'login.php';
            </script>";
        } else {
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }
    } else {
        // Tampilkan pesan error jika username/email sudah ada
        $errorMessage = '';
        if ($checkEmail > 0 && $checkUsername == 0) {
            $errorMessage = "Email is not available";
        } else if ($checkUsername > 0 && $checkEmail == 0) {
            $errorMessage = "Username is not available";
        } else {
            $errorMessage = "Username and Email are not available";
        }
        echo "<script>alert('$errorMessage');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register 2FA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            border-radius: 8px;
        }
        .text-center small {
            color: #555;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">📝 Register</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" required placeholder="Enter your full name">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required placeholder="Choose a username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" required placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Create Password</label>
                <input type="password" class="form-control" name="password" id="password" required placeholder="Create a password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" name="role" id="role" required>
                    <option value="" disabled selected hidden>-- Choose Role --</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div class="text-center mt-3">
                <small>Already have an account? <a href="login.php">Login here</a></small>
            </div>
        </form>
    </div>
</div>

</body>
</html>
