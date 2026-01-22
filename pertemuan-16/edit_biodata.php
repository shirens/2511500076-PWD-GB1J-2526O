<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('shirens.php');
}

$stmt = mysqli_prepare($conn, "
  SELECT 
    cid, kode_pengunjung, nama_pengunjung, alamat_rumah, tanggal_kunjungan,
    hobi, asal_slta, pekerjaan,
    nama_ortu, nama_pacar, nama_mantan
  FROM tbl_shirens
  WHERE cid = ? LIMIT 1
");

if (!$stmt) {
  $_SESSION['flash_error'] = 'Query tidak benar.';
  redirect_ke('shirens.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_error'] = 'Data tidak ditemukan.';
  redirect_ke('shirens.php');
}

$kode       = $row['kode_pengunjung'] ?? '';
$nama       = $row['nama_pengunjung'] ?? '';
$alamat     = $row['alamat_rumah'] ?? '';
$tanggal    = $row['tanggal_kunjungan'] ?? '';
$hobi       = $row['hobi'] ?? '';
$asal   = $row['asal_slta'] ?? '';
$pekerjaan  = $row['pekerjaan'] ?? '';
$ortu       = $row['nama_ortu'] ?? '';
$pacar      = $row['nama_pacar'] ?? '';
$mantan       = $row['nama_mantan'] ?? '';

$flash_error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Biodata</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
  <h1>Ini Header</h1>
</header>

<main>

<section id="biodata">
  <h2>Edit Biodata</h2>

  <?php if (!empty($flash_error)): ?>
    <div style="padding:10px;margin-bottom:10px;
      background:#f8d7da;color:#721c24;border-radius:6px;">
      <?= $flash_error ?>
    </div>
  <?php endif; ?>

  <form action="proses_update_biodata.php" method="POST">

    <input type="hidden" name="cid" value="<?= (int)$cid ?>">

    <label>
      <span>Kode Pengunjung</span>
      <input type="text" name="kode_pengunjung" value="<?= htmlspecialchars($kode) ?>" required>
    </label>

    <label>
      <span>Nama Pengunjung</span>
      <input type="text" name="nama_pengunjung" value="<?= htmlspecialchars($nama) ?>" required>
    </label>

    <label>
      <span>Alamat Rumah</span>
      <input type="text" name="alamat_rumah" value="<?= htmlspecialchars($alamat) ?>">
    </label>

    <label>
      <span>Tanggal Kunjungan</span>
      <input type="date" name="tanggal_kunjungan" value="<?= $tanggal ?>">
    </label>

    <label>
      <span>Hobi</span>
      <input type="text" name="hobi" value="<?= htmlspecialchars($hobi) ?>">
    </label>

    <label>
      <span>Asal Slta</span>
      <input type="text" name="asal_slta" value="<?= htmlspecialchars($asal) ?>">
    </label>

    <label>
      <span><P></P>ekerjaan</span>
      <input type="text" name="pekerjaan" value="<?= htmlspecialchars($pekerjaan) ?>">
    </label>

    <label>
      <span>Nama Ortu</span>
      <input type="text" name="nama_ortu" value="<?= htmlspecialchars($ortu) ?>">
    </label>

    <label>
      <span>Nama Pacar</span>
      <input type="text" name="nama_pacar" value="<?= htmlspecialchars($pacar) ?>">
    </label>

    <label>
      <span>Nama Mantan</span>
      <input type="text" name="nama_mantan" value="<?= htmlspecialchars($mantan) ?>">
    </label>

    <button type="submit">Kirim</button>
    <button type="reset">Batal</button>
    <a href="shirens.php" class="reset">Kembali</a>

  </form>
</body>
</html>