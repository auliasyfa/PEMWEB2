<?php
  require_once 'dbkoneksi.php';

  // 4) definisikan query
  $sql = "SELECT * FROM prodi";

// 5) Eksekusi Query
$rs = $dbh->query($sql);
?>

<table border="1" width="100%">
    <tr>
      <th>nomer</th>
      <th>kode</th>
      <th>nama prodi</th>
      <th>kepala prodi</th>
      <th>aksi</th>
    </tr>
    
<?php
$nomor = 1;
foreach($rs as $row){
  ?>
  <tr>
    <td><?php echo $nomor;?></td>
    <td><?php echo $row->kode;?></td>
    <td><?php echo $row->nama;?></td>
    <td><?php echo $row->kaprodi;?></td>
    <td>
      <a href="edit_prodi.php?id=<?php echo $row->id; ?>">Edit</a>
      <a href="hapus_prodi.php?id=<?php echo $row->id; ?>">Hapus</a>
    </td>

  </tr>
  <?php
}

?>
</table>