<?php
// Konfigurasi database
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'dbpuskesmas'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

try {
    // Membuat koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil data dari tabel klurahan
    $stmt = $pdo->query("SELECT * FROM klurahan");
    $klurahans = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Menampilkan data
    echo "<h1>Data Kelurahan</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nama Kelurahan</th></tr>";
    
    foreach ($klurahans as $klurahan) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($klurahan['id']) . "</td>";
        echo "<td>" . htmlspecialchars($klurahan['nama_kelurahan']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>