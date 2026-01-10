<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

/*
  Ambil cid dari URL dan validasi
*/
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('julio.php');
}

/*
  Ambil data biodata berdasarkan cid
*/
$stmt = mysqli_prepare($conn, "
  SELECT 
    cid, NIM, Nama_Lengkap, Tempat_Lahir, Tanggal_Lahir,
    Hobi, Pasangan, Pekerjaan,
    Nama_Ortu, Nama_Kakak, Nama_Adik
  FROM tbl_julio
  WHERE cid = ? LIMIT 1
");

if (!$stmt) {
  $_SESSION['flash_error'] = 'Query tidak benar.';
  redirect_ke('julio.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_error'] = 'Data tidak ditemukan.';
  redirect_ke('julio.php');
}

/* ===== PREFILL FORM ===== */
$nim        = $row['NIM'] ?? '';
$nama       = $row['Nama_Lengkap'] ?? '';
$tempat     = $row['Tempat_Lahir'] ?? '';
$tanggal    = $row['Tanggal_Lahir'] ?? '';
$hobi       = $row['Hobi'] ?? '';
$pasangan   = $row['Pasangan'] ?? '';
$pekerjaan  = $row['Pekerjaan'] ?? '';
$ortu       = $row['Nama_Ortu'] ?? '';
$kakak      = $row['Nama_Kakak'] ?? '';
$adik       = $row['Nama_Adik'] ?? '';

/* ===== FLASH ERROR ===== */
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
      <span>NIM</span>
      <input type="text" name="NIM" value="<?= htmlspecialchars($nim) ?>" required>
    </label>

    <label>
      <span>Nama Lengkap</span>
      <input type="text" name="Nama_Lengkap" value="<?= htmlspecialchars($nama) ?>" required>
    </label>

    <label>
      <span>Tempat Lahir</span>
      <input type="text" name="Tempat_Lahir" value="<?= htmlspecialchars($tempat) ?>">
    </label>

    <label>
      <span>Tanggal Lahir</span>
      <input type="date" name="Tanggal_Lahir" value="<?= $tanggal ?>">
    </label>

    <label>
      <span>Hobi</span>
      <input type="text" name="Hobi" value="<?= htmlspecialchars($hobi) ?>">
    </label>

    <label>
      <span>Pasangan</span>
      <input type="text" name="Pasangan" value="<?= htmlspecialchars($pasangan) ?>">
    </label>

    <label>
      <span>Pekerjaan</span>
      <input type="text" name="Pekerjaan" value="<?= htmlspecialchars($pekerjaan) ?>">
    </label>

    <label>
      <span>Nama Orang Tua</span>
      <input type="text" name="Nama_Ortu" value="<?= htmlspecialchars($ortu) ?>">
    </label>

    <label>
      <span>Nama Kakak</span>
      <input type="text" name="Nama_Kakak" value="<?= htmlspecialchars($kakak) ?>">
    </label>

    <label>
      <span>Nama Adik</span>
      <input type="text" name="Nama_Adik" value="<?= htmlspecialchars($adik) ?>">
    </label>

    <button type="submit">Update</button>
    <button type="reset">Reset</button>
    <a href="julio.php" class="reset">Kembali</a>

  </form>
</body>
</html>