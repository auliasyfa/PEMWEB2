<?php
require_once 'dbkoneksi.php';

if (isset($_GET['id'])) {
    $_idx = $_GET['id'];
    $sql = "SELECT * FROM pasien WHERE id=?";
    $st = $dbh->prepare($sql);
    $st->execute([$_idx]);
    $row = $st->fetch(PDO::FETCH_OBJ);
    $tombol = "Update";
} else {
    $tombol = "Simpan";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"], input[type="email"], textarea, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pasien</h2>
    <form action="proses_pasien.php" method="post">
        <input type="hidden" name="proses" value="<?= $tombol ?>">
        <input type="hidden" name="id" value="<?= isset($row) ? htmlspecialchars($row->id) : ''; ?>">
        <div class="form-group">
            <label for="kode">Kode:</label>
            <input type="text" id="kode" name="kode" value="<?= isset($row) ? htmlspecialchars($row->kode) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="<?= isset($row) ? htmlspecialchars($row->nama) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tmp_lahir" value="<?= isset($row) ? htmlspecialchars($row->tmp_lahir) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tgl_lahir" value="<?= isset($row) ? htmlspecialchars($row->tgl_lahir) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <input type="radio" id="laki_laki" name="gender" value="Laki-Laki" <?= (isset($row) && $row->gender == 'L') ? 'checked' : ''; ?> required>
            <label for="laki_laki">Laki-Laki</label>
            <input type="radio" id="perempuan" name="gender" value="Perempuan" <?= (isset($row) && $row->gender == 'P') ? 'checked' : ''; ?> required>
            <label for="perempuan">Perempuan</label>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= isset($row) ? htmlspecialchars($row->email) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="4" required><?= isset($row) ? htmlspecialchars($row->alamat) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="kelurahan">Kelurahan:</label>
            <select name="kelurahan" id="kelurahan" required>
                <option value="" hidden>-- Pilih Kelurahan --</option>
                <?php
                    $sql = "SELECT * FROM klurahan";
                    $st = $dbh->prepare($sql);
                    $st->execute();
                    $kelurahans = $st->fetchAll(PDO::FETCH_OBJ);
                    foreach ($kelurahans as $kel) {
                        echo '<option value="' . htmlspecialchars($kel->id) . '" ' . (isset($row) && $row->klurahan_id == $kel->id ? 'selected' : '') . '>' . htmlspecialchars($kel->nama_kelurahan) . '</option>';
                    }
                ?>
            </select>
        </div>
        <button type="submit"><?= htmlspecialchars($tombol); ?></button>
    </form>
</div>

</body>
</html>
