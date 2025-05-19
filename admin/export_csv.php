<?php
require '../vendor/autoload.php';  // Ensure Composer autoload is included
include '../include/connection.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Update vote count in t_kandidat table
$updateSuara = "UPDATE t_kandidat SET suara = (
    SELECT COUNT(*) FROM t_history WHERE t_history.nama_calon = t_kandidat.nama_calon
)";
$con->query($updateSuara);

// Query to get candidate data
$sql_kandidat = "SELECT nama_calon, suara, periode FROM t_kandidat";
$result_kandidat = $con->query($sql_kandidat);

// Check if query was successful
if (!$result_kandidat) {
    die("Query failed: " . $con->error);
}

// Calculate total votes from all candidates
$sql_total_suara = "SELECT SUM(suara) AS total_suara FROM t_kandidat";
$result_total_suara = $con->query($sql_total_suara);
$total_suara = $result_total_suara->fetch_assoc()['total_suara'];

// Create new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Kandidat');

// Column headers
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Nama Calon');
$sheet->setCellValue('C1', 'Total Suara');
$sheet->setCellValue('D1', 'Jumlah Suara (%)');
$sheet->setCellValue('E1', 'Periode');

// Header style
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
$sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

// Candidate data
$rowNumber = 2;
$no = 1;
while ($row_kandidat = $result_kandidat->fetch_assoc()) {
    // Calculate vote percentage
    $persentase = 0;
    if ($total_suara > 0) {
        $persentase = ($row_kandidat['suara'] / $total_suara) * 100;
    }

    // Write data to Excel file
    $sheet->setCellValue('A' . $rowNumber, $no++);
    $sheet->setCellValue('B' . $rowNumber, $row_kandidat['nama_calon']);
    $sheet->setCellValue('C' . $rowNumber, $row_kandidat['suara']); // Total votes
    $sheet->setCellValue('D' . $rowNumber, number_format($persentase, 2) . '%'); // Format percentage with 2 decimals
    $sheet->setCellValue('E' . $rowNumber, $row_kandidat['periode']);
    $rowNumber++;
}

// Apply border to all data
$dataStyle = [
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
];
$sheet->getStyle('A1:E' . ($rowNumber - 1))->applyFromArray($dataStyle);

// Save as Excel file
$excelFile = __DIR__ . "/data_export_" . date('Ymd') . ".xlsx";
$writer = new Xlsx($spreadsheet);
$writer->save($excelFile);

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . basename($excelFile) . '"');
header('Content-Length: ' . filesize($excelFile));

// Send file to browser for download
readfile($excelFile);

// Delete temporary file
if (file_exists($excelFile)) unlink($excelFile);

$con->close();
exit();
?>
