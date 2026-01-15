<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

if (isset($_POST['txtNim'])) {

  $nim       = bersihkan($_POST['txtNim'] ?? '');
  $nama      = bersihkan($_POST['txtNmLengkap'] ?? '');
  $tempat    = bersihkan($_POST['txtT4Lhr'] ?? '');
  $tgl_input = $_POST['txtTglLhr'] ?? '';
  $hobi      = bersihkan($_POST['txtHobi'] ?? '');
  $pasangan  = bersihkan($_POST['txtPasangan'] ?? '');
  $pekerjaan = bersihkan($_POST['txtKerja'] ?? '');
  $ortu      = bersihkan($_POST['txtNmOrtu'] ?? '');
  $kakak     = bersihkan($_POST['txtNmKakak'] ?? '');
  $adik      = bersihkan($_POST['txtNmAdik'] ?? '');

  if ($nim === '' || $nama === '') {
    $_SESSION['flash_biodata_error'] = "NIM dan Nama Lengkap wajib diisi.";
    header("Location: index.php#biodata");
    exit;
  }

  $tanggal = date('Y-m-d', strtotime($tgl_input));

  $sql = "INSERT INTO tbl_shirens
    (nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_ortu, nama_kakak, nama_adik)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
      nama_lengkap = VALUES(nama_lengkap),
      tempat_lahir = VALUES(tempat_lahir),
      tanggal_lahir = VALUES(tanggal_lahir),
      hobi = VALUES(hobi),
      pasangan = VALUES(pasangan),
      pekerjaan = VALUES(pekerjaan),
      nama_ortu = VALUES(nama_ortu),
      nama_kakak = VALUES(nama_kakak),
      nama_adik = VALUES(nama_adik)";

  $stmt = mysqli_prepare($conn, $sql);

  mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $nim,
    $nama,
    $tempat,
    $tanggal,
    $hobi,
    $pasangan,
    $pekerjaan,
    $ortu,
    $kakak,
    $adik
  );

  if (!mysqli_stmt_execute($stmt)) {
    die("SQL ERROR BIODATA: " . mysqli_error($conn));
  }

  mysqli_stmt_close($stmt);

  $_SESSION['flash_biodata'] = "Biodata berhasil disimpan.";
  header("Location: index.php#biodata");
  exit;
}