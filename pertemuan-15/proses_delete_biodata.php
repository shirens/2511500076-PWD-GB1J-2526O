<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  $cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('julio.php');
  }
  $stmt = mysqli_prepare($conn, "DELETE FROM tbl_julio
                                WHERE cid = ?");
  if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('julio.php');
  }
  mysqli_stmt_bind_param($stmt, "i", $cid);

  if (mysqli_stmt_execute($stmt)) { 
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah dihapus.';
  } else {
    $_SESSION['flash_error'] = 'Data gagal dihapus. Silakan coba lagi.';
  }
  mysqli_stmt_close($stmt);

  redirect_ke('julio.php');

/* ===============================
   VALIDASI CID
================================ */
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error'] = 'CID biodata tidak valid.';
  redirect_ke('julio.php');
}

/* ===============================
   DELETE DATA BIODATA
================================ */
$stmt = mysqli_prepare(
  $conn,
  "DELETE FROM tbl_julio WHERE cid = ?"
);

if (!$stmt) {
  $_SESSION['flash_error'] = 'Gagal memproses penghapusan data.';
  redirect_ke('julio.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['flash_sukses'] = 'Biodata berhasil dihapus.';
} else {
  $_SESSION['flash_error'] = 'Biodata gagal dihapus.';
}

mysqli_stmt_close($stmt);

redirect_ke('julio.php');