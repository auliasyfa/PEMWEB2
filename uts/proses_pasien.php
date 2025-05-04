<?php
// Mulai sesi untuk menggunakan session variables
session_start();

// Include koneksi database
require_once 'dbkoneksi.php';

// Mendapatkan data dari form
$kode      = $_POST['kode'];
$nama      = $_POST['nama'];
$tmp_lahir = $_POST['tmp_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$gender    = $_POST['gender'];
$email     = $_POST['email'];
$alamat    = $_POST['alamat'];
$kelurahan = $_POST['kelurahan'];
$_proses = $_REQUEST['proses']; // Mendapatkan jenis proses dari form

// Jika proses adalah "Tambah"
if ($_proses == "Simpan") {
    // Query untuk menambah data pasien
    $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, klurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan]);

    // Set pesan sukses
    $_SESSION['message'] = "Pasien baru berhasil ditambahkan!";

} elseif ($_proses == "Update") {
    // Jika proses adalah "Ubah"
    $_idx = $_POST['id']; // Mendapatkan ID dari form
    // Query untuk mengubah data pasien
    $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, klurahan_id=? WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan, $_idx]);

    // Set pesan sukses
    $_SESSION['message'] = "Data pasien berhasil diubah!";

} elseif ($_proses == "Delete") {
    // Jika ada permintaan untuk menghapus
    $_idx = $_GET['id']; // Mendapatkan ID dari URL
    // Query untuk menghapus data pasien
    $sql = "DELETE FROM pasien WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_idx]);

    // Set pesan sukses
    $_SESSION['message'] = "Data pasien berhasil dihapus!";
}

// Redirect ke halaman data_pasien.php
header('Location: index.php?hal=data-pasien');
exit; // Pastikan tidak ada kode lain yang dijalankan setelah redirect
?>
