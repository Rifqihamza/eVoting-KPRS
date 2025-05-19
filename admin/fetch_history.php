<?php
require('../include/connection.php');

// Pastikan request berasal dari AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $nama_kandidat = $_POST['nama_kandidat'] ?? '';
    $nama_kelas = $_POST['nama_kelas'] ?? '';

    // Base query
    $history_sql = "SELECT h.nis, h.fullname, h.nama_kelas, h.nama_calon, h.periode, h.timestamp 
                    FROM t_history h
                    LEFT JOIN t_kandidat k ON h.nama_calon = k.nama_calon
                    WHERE 1=1"; // Memastikan WHERE tetap valid jika tidak ada filter

    // Dynamic condition
    $params = [];
    $types = '';

    if (!empty($nama_kandidat)) {
        $history_sql .= " AND k.nama_calon LIKE ?";
        $params[] = "%$nama_kandidat%";
        $types .= 's';
    }
    if (!empty($nama_kelas)) {
        $history_sql .= " AND h.nama_kelas LIKE ?";
        $params[] = "%$nama_kelas%";
        $types .= 's';
    }

    $stmt = $con->prepare($history_sql);

    // Bind parameter jika ada filter
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $history_result = $stmt->get_result();

    $output = "";
    if ($history_result && $history_result->num_rows > 0) {
        $no = 1;
        while ($row = $history_result->fetch_assoc()) {
            $formattedTime = date("d M Y, H:i", strtotime($row['timestamp']));
            $output .= "<tr>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$no}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['nis']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['fullname']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['nama_kelas']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['nama_calon']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['periode']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$formattedTime}</td>
                        </tr>";
            $no++;
        }
    } else {
        $output = "<tr><td colspan='7' class='px-6 py-4 text-xl text-gray-700 text-center'>Tidak ada data yang ditemukan</td></tr>";
    }

    echo $output;
    exit;
}
?>
