# 🔐 Simple PHP 2FA Login + Brute Force Simulation

![PHP](https://img.shields.io/badge/PHP-8892BF?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PHPMailer](https://img.shields.io/badge/PHPMailer-000?style=for-the-badge&logo=phpmailer&logoColor=white)

Sistem login sederhana berbasis **PHP & MySQL** yang mendukung **verifikasi OTP (2FA)** via email menggunakan **PHPMailer**, serta dilengkapi simulasi **brute force attack GUI** untuk pembelajaran keamanan web.

---

## ✨ Fitur Utama

- 🔐 **Login + OTP** via email (2FA)
- ✉️ Pengiriman OTP menggunakan Gmail SMTP (via App Password)
- 📁 Manajemen session setelah verifikasi OTP berhasil
- 🧪 Simulasi GUI Brute Force: HTML interface untuk uji login endpoint
- 📸 UI responsif berbasis Bootstrap

---

## 🖼️ UI Preview

| Halaman Login | Registrasi | Dashboard |
|---------------|------------|-----------|
| ![Login](https://raw.githubusercontent.com/atikfriana/Simple-PHP-2FA-Login/main/screenshots/login.jpg) | ![Register](https://raw.githubusercontent.com/atikfriana/Simple-PHP-2FA-Login/main/screenshots/register.jpg) | ![Dashboard](https://raw.githubusercontent.com/atikfriana/Simple-PHP-2FA-Login/main/screenshots/dashboard.jpg) |

| Simulasi Brute GUI | Hasil Brute |
|--------------------|-------------|
| ![Brute GUI](https://raw.githubusercontent.com/atikfriana/Simple-PHP-2FA-Login/main/screenshots/brutetest.jpg) | ![Brute Result](https://raw.githubusercontent.com/atikfriana/Simple-PHP-2FA-Login/main/screenshots/bruteresult.jpg) |

---

## ⚙️ Teknologi yang Digunakan

| Teknologi     | Fungsi                                |
|---------------|----------------------------------------|
| PHP           | Backend / logika login                 |
| MySQL         | Menyimpan data pengguna & OTP          |
| PHPMailer     | Kirim OTP via email                    |
| Gmail SMTP    | Server pengiriman email (App Password) |
| Bootstrap 5   | Tampilan antarmuka GUI                 |
| XAMPP         | Server lokal (Apache + MySQL + PHP)    |

---

## 🚀 Setup (Localhost)

### 1. Clone Repo
```bash
git clone https://github.com/atikfriana/Simple-PHP-2FA-Login.git
````

### 2. Pindahkan ke `htdocs`

```plaintext
C:\xampp\htdocs\Simple-PHP-2FA-Login
```

### 3. Buat Database

* Buka `http://localhost/phpmyadmin`
* Buat database: `tfa_db`
* Import file SQL (misalnya `otp_login.sql`)

### 4. Konfigurasi PHPMailer

Ubah di `koneksi.php`:

```php
$mail->Username = 'emailkamu@gmail.com';
$mail->Password = 'sandi_aplikasi'; // Bukan password Gmail biasa
```

🔗 [Panduan buat App Password Gmail](https://support.google.com/accounts/answer/185833)

### 5. Jalankan XAMPP

* Aktifkan **Apache** & **MySQL**

### 6. Akses Aplikasi

* Login: `http://localhost/Simple-PHP-2FA-Login/login.php`
* Brute GUI: `http://localhost/Simple-PHP-2FA-Login/brute_gui.html`

---

## 🛡️ Tentang Brute GUI

File `brute_gui.html` digunakan untuk mensimulasikan serangan brute-force lokal ke `api_login.php`.

> ⚠️ Hanya untuk pembelajaran. Jangan gunakan pada server publik.

---

## 📂 Struktur Folder

```
Simple-PHP-2FA-Login/
├── admin_dashboard.php
├── api_login.php
├── brute_gui.php
├── cek_login.php
├── composer.lock
├── cookie                
├── dashboard.php
├── koneksi.php
├── login.php
├── logout.php
├── register.php
├── resend_otp.php
├── screenshots/
│   ├── login.jpg
│   ├── register.jpg
│   ├── dashboard.jpg
│   ├── brutetest.jpg
│   └── bruteresult.jpg
├── twofactor_authentication.sql
├── user_dashboard.php
├── vendor/                <-- composer packages
└── verify_otp.php

```

---

## 🤝 Kontribusi

Kontribusi terbuka!
Pull request, issue, atau diskusi pengembangan sangat disambut.

---

## 📄 Lisensi

Lisensi: [MIT License](https://opensource.org/licenses/MIT)

---
