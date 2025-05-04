<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpuskesmas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani pengiriman form untuk menambahkan pemeriksaan baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];
    $tanggal = $_POST['tanggal'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi = $_POST['tensi'];
    $keterangan = $_POST['keterangan'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sddssii", $tanggal, $berat, $tinggi, $tensi, $keterangan, $pasien_id, $dokter_id);

    if ($stmt->execute()) {
        echo "<script>alert('Data Berhasil ditambahkan')</script>";
    } else {
        echo "<script>alert('Data tidak berhasil ditambahkan')</script>";
    }
    // Redirect ke halaman yang sama untuk menghindari pengiriman ulang form
    echo "<script>window.location.href='index.php?hal=data-periksa';</script>";
    $stmt->close();
}

// Mengambil data pasien
$pasien_query = "SELECT id, nama FROM pasien";
$pasien_result = $conn->query($pasien_query);

// Mengambil seluruh data paramedik tanpa filter karena kolom kategori/role tidak pasti ada
$dokter_query = "SELECT id, nama FROM paramedik";
$dokter_result = $conn->query($dokter_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 20px auto;
            padding: 10px;
        }
        label {
            font-weight: bold;
        }
        select, input[type="date"], input[type="number"], input[type="text"], textarea {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 18px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h2>Form Pemeriksaan Pasien</h2>
    <form action="periksaan_pasien.php" method="POST">
        <label for="pasien_id">Pasien:</label>
        <select name="pasien_id" id="pasien_id" required>
            <option value="">Pilih Pasien</option>
            <?php if ($pasien_result): ?>
                <?php while($row = $pasien_result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['nama']) ?></option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>

        <label for="dokter_id">Dokter:</label>
        <select name="dokter_id" id="dokter_id" required>
            <option value="">Pilih Dokter</option>
            <?php if ($dokter_result): ?>
                <?php while($row = $dokter_result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['nama']) ?></option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>

        <label for="tanggal">Tanggal Pemeriksaan:</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <label for="berat">Berat Badan (kg):</label>
        <input type="number" step="any" name="berat" id="berat" required min="0">

        <label for="tinggi">Tinggi Badan (cm):</label>
        <input type="number" step="any" name="tinggi" id="tinggi" required min="0">

        <label for="tensi">Tensi Darah:</label>
        <input type="text" name="tensi" id="tensi" required>

        <label for="keterangan">Keterangan:</label>
        <textarea name="keterangan" id="keterangan" rows="4" required></textarea>

        <button type="submit">Simpan Pemeriksaan</button>
    </form>

    <hr>

    <h3>Daftar Pemeriksaan Pasien</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Berat Badan</th>
                <th>Tinggi Badan</th>
                <th>Tensi Darah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $periksa_query = "SELECT p.tanggal, ps.nama AS pasien, d.nama AS dokter, p.berat, p.tinggi, p.tensi, p.keterangan
                              FROM periksa p
                              JOIN pasien ps ON p.pasien_id = ps.id
                              JOIN paramedik d ON p.dokter_id = d.id";
            $periksa_result = $conn->query($periksa_query);

            if ($periksa_result):
                while ($row = $periksa_result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    <td><?= htmlspecialchars($row['pasien']) ?></td>
                    <td><?= htmlspecialchars($row['dokter']) ?></td>
                    <td><?= htmlspecialchars($row['berat']) ?></td>
                    <td><?= htmlspecialchars($row['tinggi']) ?></td>
                    <td><?= htmlspecialchars($row['tensi']) ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                </tr>
            <?php
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
