<?php
include '../include/connection.php';  // Koneksi ke database
require '../vendor/autoload.php'; // Memuat autoloader Composer untuk PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Query untuk mengambil data dari tabel t_history
$sql_history = "SELECT nis, fullname, nama_kelas, nama_calon, periode, timestamp FROM t_history";
$result_history = $con->query($sql_history);

// Periksa apakah query berhasil
if (!$result_history) {
    die("Query gagal: " . $con->error);
}

// Membuat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Menulis header kolom ke sheet Excel
$sheet->setCellValue('A1', 'Token');
$sheet->setCellValue('B1', 'Nama Lengkap');
$sheet->setCellValue('C1', 'Kelas');
$sheet->setCellValue('D1', 'Nama Kandidat');
$sheet->setCellValue('E1', 'Periode');
$sheet->setCellValue('F1', 'Waktu');

// Gaya untuk header tabel
$headerStyle = [
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'D9D9D9']
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
];
$sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

// Menulis data dari tabel t_history ke sheet Excel
$row_num = 2; // Mulai menulis di baris kedua setelah header
while ($row = $result_history->fetch_assoc()) {
    $sheet->setCellValue('A' . $row_num, $row['nis']);
    $sheet->setCellValue('B' . $row_num, $row['fullname']);
    $sheet->setCellValue('C' . $row_num, $row['nama_kelas']);
    $sheet->setCellValue('D' . $row_num, $row['nama_calon']);
    $sheet->setCellValue('E' . $row_num, $row['periode']);
    $sheet->setCellValue('F' . $row_num, date("d M Y, H:i", strtotime($row['timestamp'])));
    $row_num++;
}

// Set file Excel output path
$excelFile = __DIR__ . "/history_export_" . date('Ymd') . ".xlsx";

// Menulis file Excel ke disk
$writer = new Xlsx($spreadsheet);
$writer->save($excelFile);

// Set header untuk mengunduh file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . basename($excelFile) . '"');
header('Content-Length: ' . filesize($excelFile));

// Mengirim file Excel ke browser untuk diunduh
readfile($excelFile);

// Menghapus file sementara
unlink($excelFile);

$con->close();
exit();
?>
