<?php
require_once 'dbkoneksi.php';

// Ambil data pasien
$query = "SELECT * FROM pasien";
try {
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $pasien = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Query gagal: " . htmlspecialchars($e->getMessage());
    exit;
} catch (PDOException $e) {
    echo "Query gagal: " . htmlspecialchars($e->getMessage());
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        /* Custom styles */
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <aside class="main-sidebar elevation-4">
        <div class="sidebar">
            <h4 class="brand-text">AdminLTE</h4>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?hal=data_pasien.php" class="nav-link active">Data Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?hal=data-periksa" class="nav-link">Pemeriksaan Pasien</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <div class="container">
            <h2>Data Pasien</h2>
            <a href="index.php?hal=tambah-pasien" class="btn btn-primary mb-3">Tambah Pasien</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pasien)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($pasien as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row->kode); ?></td>
                            <td><?= htmlspecialchars($row->nama); ?></td>
                            <td><?= htmlspecialchars($row->alamat); ?></td>
                            <td><?= htmlspecialchars($row->email); ?></td>
                            <td>
                                <a href="index.php?hal=tambah-pasien&id=<?= htmlspecialchars($row->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses_pasien.php?proses=Delete&id=<?= htmlspecialchars($row->id); ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">Tidak ada data pasien</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
