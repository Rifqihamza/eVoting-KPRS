<?php
require('../include/connection.php');

// Only process AJAX requests
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $nama_calon = isset($_POST['request']) ? $_POST['request'] : '';

    // Base query
    $history_sql = "SELECT h.nis, h.fullname, h.nama_calon, h.periode, h.timestamp 
                     FROM t_history h
                     LEFT JOIN t_kandidat k ON h.nama_calon = k.nama_calon";

    if (!empty($nama_calon)) {
        $history_sql .= " WHERE k.nama_calon LIKE ?"; 
        $stmt = $con->prepare($history_sql);
        $nama_calon = "%{$nama_calon}%"; // Add wildcards for partial matching
        $stmt->bind_param('s', $nama_calon); 
    } else {
        $stmt = $con->prepare($history_sql);
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
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['nama_calon']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$row['periode']}</td>
                            <td class='px-6 py-4 text-xl text-gray-700'>{$formattedTime}</td>
                        </tr>";
            $no++;
        }
    } else {
        $output = "<tr><td colspan='6' class='px-6 py-4 text-xl text-gray-700 text-center'>Tidak ada data yang ditemukan</td></tr>";
    }

    echo $output;
    exit;
}
?>