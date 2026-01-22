<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

if (isset($_POST['txtKodePen'])) {

  $kode       = bersihkan($_POST['txtKodePen'] ?? '');
  $nama      = bersihkan($_POST['txtNmPengunjung'] ?? '');
  $alamat    = bersihkan($_POST['txtAlRmh'] ?? '');
  $tgl_input = $_POST['txtTglKunjungan'] ?? '';
  $hobi      = bersihkan($_POST['txtHobi'] ?? '');
  $asal  = bersihkan($_POST['txtAsalSMA'] ?? '');
  $pekerjaan = bersihkan($_POST['txtKerja'] ?? '');
  $ortu      = bersihkan($_POST['txtNmOrtu'] ?? '');
  $pacar     = bersihkan($_POST['txtNmPacar'] ?? '');
  $mantan     = bersihkan($_POST['txtNmMantan'] ?? '');

  if ($nim === '' || $nama === '') {
    $_SESSION['flash_biodata_error'] = "Kode Pengunjung dan Nama Pengunjung wajib diisi.";
    header("Location: index.php#biodata");
    exit;
  }

  $tanggal = date('Y-m-d', strtotime($tgl_input));

  $sql = "INSERT INTO tbl_shirens
    (kode_pengunjung, nama_pengunjung, alamat_rumah, tanggal_kunjungan, hobi, asal_slta, pekerjaan, nama_ortu, nama_pacar, nama_mantan)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
      nama_pengunjung = VALUES(nama_pengunjung),
      alamat_rumah = VALUES(alamat_rumah),
      tanggal_kunjungan = VALUES(tanggal_kunjungan),
      hobi = VALUES(hobi),
      asal_slta = VALUES(asal_slta),
      pekerjaan = VALUES(pekerjaan),
      nama_ortu = VALUES(nama_ortu),
      nama_pacar = VALUES(nama_pacar),
      nama_mantan = VALUES(nama_mantan)";

  $stmt = mysqli_prepare($conn, $sql);

  mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $kode,
    $nama,
    $alamat,
    $tanggal,
    $hobi,
    $asal,
    $pekerjaan,
    $ortu,
    $pacar,
    $mantan
  );

  if (!mysqli_stmt_execute($stmt)) {
    die("SQL ERROR BIODATA: " . mysqli_error($conn));
  }

  mysqli_stmt_close($stmt);

  $_SESSION['flash_biodata'] = "Biodata berhasil disimpan.";
  header("Location: index.php#biodata");
  exit;
}