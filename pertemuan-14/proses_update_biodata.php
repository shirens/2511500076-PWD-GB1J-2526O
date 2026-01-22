<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('shirens.php');
}

$nim        = trim($_POST['nim'] ?? '');
$nama       = trim($_POST['nama_lengkap'] ?? '');
$tempat     = trim($_POST['tempat_lahir'] ?? '');
$tanggal    = $_POST['tanggal_lahir'] ?? '';
$hobi       = trim($_POST['hobi'] ?? '');
$pasangan   = trim($_POST['pasangan'] ?? '');
$pekerjaan  = trim($_POST['pekerjaan'] ?? '');
$ortu       = trim($_POST['nama_ortu'] ?? '');
$kakak      = trim($_POST['nama_kakak'] ?? '');
$adik       = trim($_POST['nama_adik'] ?? '');

$stmt = mysqli_prepare($conn, "
  UPDATE tbl_shirens SET
'nim = ?,
    nama_lengkap = ?,
    tempat_lahir = ?,
    tanggal_lahir = ?,
    hobi = ?,
    pasangan = ?,
    pekerjaan = ?,
    nama_ortu = ?,
    nama_kakak = ?,
    nama_adik = ?
  WHERE cid = ?
");

if (!$stmt) {
  $_SESSION['flash_error'] = 'Query gagal disiapkan.';
  redirect_ke('shirens.php');
}

mysqli_stmt_bind_param(
  $stmt,
  "ssssssssssi",
  $nim,
  $nama,
  $tempat,
  $tanggal,
  $hobi,
  $pasangan,
  $pekerjaan,
  $ortu,
  $kakak,
  $adik,
  $cid
);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['flash_sukses'] = 'Biodata berhasil diperbarui.';
} else {
  $_SESSION['flash_error'] = 'Gagal memperbarui biodata.';
}

mysqli_stmt_close($stmt);

redirect_ke('shirens.php');