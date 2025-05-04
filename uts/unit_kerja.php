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

    // Query untuk mengambil data dari tabel unit_kerja
    $stmt = $pdo->query("SELECT * FROM unit_kerja");
    $unit_kerjas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Menampilkan data
    echo "<h1>Data Unit Kerja</h1>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Kode Unit</th>
            <th>Nama Unit</th>
            <th>Keterangan</th>
          </tr>";
    
    foreach ($unit_kerjas as $unit_kerja) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($unit_kerja['id']) . "</td>";
        echo "<td>" . htmlspecialchars($unit_kerja['kode_unit']) . "</td>";
        echo "<td>" . htmlspecialchars($unit_kerja['nama_unit']) . "</td>";
        echo "<td>" . htmlspecialchars($unit_kerja['keterangan']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>