<?php
// Set timezone to Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');
session_start();
if (!isset($_SESSION['siswa']) || !isset($_GET['id'])) {
    header('location:./');
    exit();
}

define('BASEPATH', dirname(__FILE__));
require('./include/connection.php');

$thn  = date('Y');
$dpn   = date('Y') + 1;
$periode = $thn . '/' . $dpn;
$suara = $_GET['s'] + 1;
$timestamp = date('Y-m-d H:i:s'); // Define the timestamp

// Mulai transaction
$con->begin_transaction();

try {
    // Update suara kandidat
    $update = $con->prepare("UPDATE t_kandidat SET suara = ? WHERE id_kandidat = ?") or die($con->error);
    $update->bind_param('is', $suara, $_GET['id']);
    $update->execute();

    // Ambil fullname dan id_kelas dari tabel t_user
    $stmt = $con->prepare("SELECT fullname, id_kelas FROM t_user WHERE id_user = ?");
    $stmt->bind_param('s', $_SESSION['siswa']);
    $stmt->execute();
    $stmt->bind_result($fullname, $id_kelas);
    $stmt->fetch();
    $stmt->close();

    // Ambil nama_kelas dari tabel t_kelas
    $stmtKelas = $con->prepare("SELECT nama_kelas FROM t_kelas WHERE id_kelas = ?");
    $stmtKelas->bind_param('s', $id_kelas);
    $stmtKelas->execute();
    $stmtKelas->bind_result($nama_kelas);
    $stmtKelas->fetch();
    $stmtKelas->close();

    // Ambil nama_calon dari tabel t_kandidat
    $stmtCalon = $con->prepare("SELECT nama_calon FROM t_kandidat WHERE id_kandidat = ?");
    $stmtCalon->bind_param('s', $_GET['id']);
    $stmtCalon->execute();
    $stmtCalon->bind_result($nama_calon);
    $stmtCalon->fetch();
    $stmtCalon->close();

    // Cek apakah siswa sudah memilih sebelumnya
    $check = $con->prepare("SELECT COUNT(*) FROM t_pemilih WHERE nis = ? AND periode = ?");
    $check->bind_param('ss', $_SESSION['siswa'], $periode);
    $check->execute();
    $check->bind_result($count);
    $check->fetch();
    $check->close();

    if ($count > 0) {
        throw new Exception("Anda sudah melakukan pemilihan sebelumnya!");
    }

    // Simpan data pemilih
    $save = $con->prepare("INSERT INTO t_pemilih(nis, fullname, periode) VALUES(?, ?, ?)");
    $save->bind_param('sss', $_SESSION['siswa'], $fullname, $periode);
    $save->execute();

    // Simpan riwayat pilihan pemilih
    $history = $con->prepare("INSERT INTO t_history(nis, fullname, nama_kelas, nama_calon, periode, timestamp) VALUES(?, ?, ?, ?, ?, ?)");
    $history->bind_param('ssssss', $_SESSION['siswa'], $fullname, $nama_kelas, $nama_calon, $periode, $timestamp);
    $history->execute();

    // Commit transaction jika semua berhasil
    $con->commit();

    // Hapus session dan redirect
    unset($_SESSION['siswa']);
    session_destroy();

    header('location:./thanks.php');
    exit();
} catch (Exception $e) {
    // Rollback jika terjadi error
    $con->rollback();

    $_SESSION['error'] = $e->getMessage();
    header('location:./index.php?error=1');
    exit();
}
?>
