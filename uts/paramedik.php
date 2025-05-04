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

    // Query untuk mengambil data dari tabel paramedik
    $stmt = $pdo->query("SELECT * FROM paramedik");
    $paramediks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Menampilkan data
    echo "<h1>Data Paramedik</h1>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Kategori</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Unit Kerja ID</th>
          </tr>";
    
    foreach ($paramediks as $paramedik) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($paramedik['id']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['gender']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['tmp_lahir']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['tgl_lahir']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['kategori']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['telpon']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['alamat']) . "</td>";
        echo "<td>" . htmlspecialchars($paramedik['unitkerja_id']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>