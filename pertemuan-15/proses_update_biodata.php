<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

/* ===============================
   VALIDASI CID
================================ */
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('julio.php');
}

/* ===============================
   AMBIL & BERSIHKAN INPUT
================================ */
$nim        = trim($_POST['NIM'] ?? '');
$nama       = trim($_POST['Nama_Lengkap'] ?? '');
$tempat     = trim($_POST['Tempat_Lahir'] ?? '');
$tanggal    = $_POST['Tanggal_Lahir'] ?? '';
$hobi       = trim($_POST['Hobi'] ?? '');
$pasangan   = trim($_POST['Pasangan'] ?? '');
$pekerjaan  = trim($_POST['Pekerjaan'] ?? '');
$ortu       = trim($_POST['Nama_Ortu'] ?? '');
$kakak      = trim($_POST['Nama_Kakak'] ?? '');
$adik       = trim($_POST['Nama_Adik'] ?? '');

/* ===============================
   QUERY UPDATE
================================ */
$stmt = mysqli_prepare($conn, "
  UPDATE tbl_julio SET
    NIM = ?,
    Nama_Lengkap = ?,
    Tempat_Lahir = ?,
    Tanggal_Lahir = ?,
    Hobi = ?,
    Pasangan = ?,
    Pekerjaan = ?,
    Nama_Ortu = ?,
    Nama_Kakak = ?,
    Nama_Adik = ?
  WHERE cid = ?
");

if (!$stmt) {
  $_SESSION['flash_error'] = 'Query gagal disiapkan.';
  redirect_ke('julio.php');
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

/* ===============================
   EKSEKUSI
================================ */
if (mysqli_stmt_execute($stmt)) {
  $_SESSION['flash_sukses'] = 'Biodata berhasil diperbarui.';
} else {
  $_SESSION['flash_error'] = 'Gagal memperbarui biodata.';
}

mysqli_stmt_close($stmt);

redirect_ke('julio.php');