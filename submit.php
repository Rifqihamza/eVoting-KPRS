<?php
session_start();
if (!isset($_SESSION['siswa']) || !isset($_GET['id'])) {
    header('location:./');
}

define('BASEPATH', dirname(__FILE__));
require('./include/connection.php');

$thn  = date('Y');
$dpn   = date('Y') + 1;
$periode = $thn . '/' . $dpn;
$suara = $_GET['s'] + 1;

// Update suara kandidat
$update = $con->prepare("UPDATE t_kandidat SET suara = ? WHERE id_kandidat = ?") or die($con->error);
$update->bind_param('is', $suara, $_GET['id']);
$update->execute();

// Ambil fullname dan id_kelas dari tabel t_user berdasarkan id_user
$stmt = $con->prepare("SELECT fullname, id_kelas FROM t_user WHERE id_user = ?");
$stmt->bind_param('s', $_SESSION['siswa']);
$stmt->execute();
$stmt->bind_result($fullname, $id_kelas);
$stmt->fetch();
$stmt->close();

// Ambil nama_kelas dari tabel t_kelas berdasarkan id_kelas
$stmtKelas = $con->prepare("SELECT nama_kelas FROM t_kelas WHERE id_kelas = ?");
$stmtKelas->bind_param('s', $id_kelas);
$stmtKelas->execute();
$stmtKelas->bind_result($nama_kelas);
$stmtKelas->fetch();
$stmtKelas->close();

// Ambil nama_calon dari tabel t_kandidat berdasarkan id_kandidat
$stmtCalon = $con->prepare("SELECT nama_calon FROM t_kandidat WHERE id_kandidat = ?");
$stmtCalon->bind_param('s', $_GET['id']);
$stmtCalon->execute();
$stmtCalon->bind_result($nama_calon);
$stmtCalon->fetch();
$stmtCalon->close();

// Simpan data pemilih
$save = $con->prepare("INSERT INTO t_pemilih(nis, fullname, periode) VALUES(?, ?, ?)");
$save->bind_param('sss', $_SESSION['siswa'], $fullname, $periode);
$save->execute();

// Simpan riwayat pilihan pemilih dengan nama_kelas
$history = $con->prepare("INSERT INTO t_history(nis, fullname, nama_kelas, nama_calon, periode) VALUES(?, ?, ?, ?, ?)");
$history->bind_param('sssss', $_SESSION['siswa'], $fullname, $nama_kelas, $nama_calon, $periode);
$history->execute();

unset($_SESSION['siswa']);

header('location:./index.php?page=thanks');
