<?php
$host     = "localhost";     // Atau "127.0.0.1"
$username = "root";          // Username MySQL-mu
$password = "";              // Kosongkan kalau tidak ada password
$database = "twofactor_authentication";  // Ganti dengan nama database kamu

$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
 integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<style>
body{
    display: flex;
    justify-content: center;
    align-items: center;
}
h1,h2,h3,h4.h5{
    margin: 0px;
    padding: 0px;
}
</style>
