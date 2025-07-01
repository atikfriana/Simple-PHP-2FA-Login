<?php
// api_login.php

// Cek metode request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Ambil data POST
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        echo json_encode([
            "status" => "error",
            "message" => "Kirim POST request dengan username dan password"
        ]);
        exit;
    }

    // Contoh validasi user statis, bisa diganti cek DB
    if ($username === 'atik' && $password === '1234') {
        echo json_encode([
            "status" => "success",
            "message" => "Password valid, lanjut OTP"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Username atau password salah"
        ]);
    }

    exit; // selesai response JSON
}

// Kalau bukan POST (biasanya GET), tampilkan form HTML biasa
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Form Login API</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
 integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #f8f9fa;
    font-family: Arial, sans-serif;
  }
  .card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 320px;
  }
  h3 {
    margin-bottom: 1.5rem;
  }
</style>
</head>
<body>
  <div class="card">
    <h3 class="text-center">Login Form</h3>
    <form method="POST" id="loginForm">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required />
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div id="response" class="mt-3"></div>
  </div>

  <script>
    const form = document.getElementById('loginForm');
    const responseDiv = document.getElementById('response');

    form.addEventListener('submit', async e => {
      e.preventDefault();

      const formData = new FormData(form);
      responseDiv.textContent = 'Loading...';

      try {
        const res = await fetch('', {  // request ke file yang sama
          method: 'POST',
          body: formData,
        });
        const data = await res.json();

        if(data.status === 'success') {
          responseDiv.style.color = 'green';
          responseDiv.textContent = data.message;
          // Bisa lanjut logic OTP di sini
        } else {
          responseDiv.style.color = 'red';
          responseDiv.textContent = data.message;
        }
      } catch(err) {
        responseDiv.style.color = 'red';
        responseDiv.textContent = 'Error saat menghubungi server';
      }
    });
  </script>
</body>
</html>
