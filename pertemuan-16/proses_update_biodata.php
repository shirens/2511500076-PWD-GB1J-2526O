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

$kode       = trim($_POST['kode_pengunjung'] ?? '');
$nama       = trim($_POST['nama_pengunjung'] ?? '');
$alamat     = trim($_POST['alamat_rumah'] ?? '');
$hobi       = trim($_POST['hobi'] ?? '');
$asal       = trim($_POST['asal_slta'] ?? '');
$pekerjaan  = trim($_POST['pekerjaan'] ?? '');
$ortu       = trim($_POST['nama_ortu'] ?? '');
$pacar      = trim($_POST['nama_pacar'] ?? '');
$mantan     = trim($_POST['nama_mantan'] ?? '');

$tgl_input = $_POST['tanggal_kunjungan'] ?? '';
$tanggal   = ($tgl_input === '') ? null : date('Y-m-d', strtotime($tgl_input));

$stmt = mysqli_prepare($conn, "
  UPDATE tbl_shirens SET
    kode_pengunjung = ?,
    nama_pengunjung = ?,
    alamat_rumah = ?,
    tanggal_kunjungan = ?,
    hobi = ?,
    asal_slta = ?,
    pekerjaan = ?,
    nama_ortu = ?,
    nama_pacar = ?,
    nama_mantan = ?
  WHERE cid = ?
");

if (!$stmt) {
  $_SESSION['flash_error'] = 'Query gagal disiapkan.';
  redirect_ke('shirens.php');
}

mysqli_stmt_bind_param(
  $stmt,
  "ssssssssssi",
  $kode,
  $nama,
  $alamat,
  $tanggal,
  $hobi,
  $asal,
  $pekerjaan,
  $ortu,
  $pacar,
  $mantan,
  $cid
);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['flash_sukses'] = 'Biodata berhasil diperbarui.';
} else {
  $_SESSION['flash_error'] = 'Gagal memperbarui biodata.';
}

mysqli_stmt_close($stmt);
redirect_ke('shirens.php');
