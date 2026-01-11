<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $sql = "SELECT * FROM tbl_julio ORDER BY cid DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>

<?php
  $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
  $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
  #bersihkan session ini
  unset($_SESSION['flash_sukses'], $_SESSION['flash_error']); 
?>

<?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Aksi</th>
    <th>NIM</th>
    <th>Nama Lengkap</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Hobi</th>
    <th>Pasangan</th>
    <th>Pekerjaan</th>
    <th>Nama Ortu</th>
    <th>Nama Kakak</th>
    <th>Nama Adik</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit_biodata.php?cid=<?= (int)$row['cid']; ?>">Edit</a>

        <a 
        onclick="return confirm('Hapus data <?= htmlspecialchars($row['Nama_Lengkap']); ?> ?')"
        href="proses_delete_biodata.php?cid=<?= (int)$row['cid']; ?>">
        Delete</a>
      </td>
          <td><?= htmlspecialchars($row['NIM']); ?></td>
      <td><?= htmlspecialchars($row['Nama_Lengkap']); ?></td>
      <td><?= htmlspecialchars($row['Tempat_Lahir']); ?></td>
      <td><?= nl2br(htmlspecialchars($row['Tanggal_Lahir'])); ?></td>
      <td><?= htmlspecialchars($row['Hobi']); ?></td>
      <td><?= htmlspecialchars($row['Pasangan']); ?></td>
      <td><?= htmlspecialchars($row['Pekerjaan']); ?></td>
      <td><?= htmlspecialchars($row['Nama_Ortu']); ?></td>
      <td><?= htmlspecialchars($row['Nama_Kakak']); ?></td>
      <td><?= htmlspecialchars($row['Nama_Adik']); ?></td>
      <td><?= formatTanggal(htmlspecialchars($row['created_at'])); ?></td>
    </tr>
  <?php endwhile; ?>
</table>