<?php
  require_once 'dbkoneksi.php';
  // 4) definisikan query
  $sql = "SELECT * FROM mahasiswa order BY thn_masuk desc";
  // 5) Jalankan wuery
  $rs = $dbh->query($sql);
  // 6) tampilkan hasil query
  foreach($rs as $row){
    echo "<br>".$row->nim .'_'.$row->nama;
  }
?>