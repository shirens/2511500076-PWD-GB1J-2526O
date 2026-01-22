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
    cid, nim, nama_engkap, tempat_lahir, tanggal_lahir,
    hobi, pasangan, pekerjaan,
    nama_ortu, nama_kakak, nama_adik
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

$nim        = $row['nim'] ?? '';
$nama       = $row['nama_engkap'] ?? '';
$tempat     = $row['tempat_lahir'] ?? '';
$tanggal    = $row['tanggal_lahir'] ?? '';
$hobi       = $row['hobi'] ?? '';
$pasangan   = $row['pasangan'] ?? '';
$pekerjaan  = $row['pekerjaan'] ?? '';
$ortu       = $row['nama_ortu'] ?? '';
$kakak      = $row['nama_kakak'] ?? '';
$adik       = $row['nama_adik'] ?? '';

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
      <span>Nim</span>
      <input type="text" name="nim" value="<?= htmlspecialchars($nim) ?>" required>
    </label>

    <label>
      <span>Nama Lengkap</span>
      <input type="text" name="nama_engkap" value="<?= htmlspecialchars($nama) ?>" required>
    </label>

    <label>
      <span>Tempat Lahir</span>
      <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($tempat) ?>">
    </label>

    <label>
      <span>Tanggal Lahir</span>
      <input type="date" name="tanggal_lahir" value="<?= $tanggal ?>">
    </label>

    <label>
      <span>Hobi</span>
      <input type="text" name="hobi" value="<?= htmlspecialchars($hobi) ?>">
    </label>

    <label>
      <span>Pasangan</span>
      <input type="text" name="pasangan" value="<?= htmlspecialchars($pasangan) ?>">
    </label>

    <label>
      <span>Pekerjaan</span>
      <input type="text" name="pekerjaan" value="<?= htmlspecialchars($pekerjaan) ?>">
    </label>

    <label>
      <span>Nama Orang Tua</span>
      <input type="text" name="nama_ortu" value="<?= htmlspecialchars($ortu) ?>">
    </label>

    <label>
      <span>Nama Kakak</span>
      <input type="text" name="nama_kakak" value="<?= htmlspecialchars($kakak) ?>">
    </label>

    <label>
      <span>Nama Adik</span>
      <input type="text" name="nama_adik" value="<?= htmlspecialchars($adik) ?>">
    </label>

    <button type="submit">Kirim</button>
    <button type="reset">Batal</button>
    <a href="shirens.php" class="reset">Kembali</a>

  </form>
</body>
</html>