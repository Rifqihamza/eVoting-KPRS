<?php
require('../include/connection.php');

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kandidat = $_POST['nama_kandidat'] ?? '';
    $nama_kelas = $_POST['nama_kelas'] ?? '';

    $history_sql = "SELECT nis, fullname, nama_kelas, nama_calon, periode, timestamp FROM t_history WHERE 1=1";

    if (!empty($nama_kandidat)) {
        $history_sql .= " AND nama_calon LIKE ?";
    }
    if (!empty($nama_kelas)) {
        $history_sql .= " AND nama_kelas LIKE ?";
    }

    $stmt = $con->prepare($history_sql);

    // Bind parameters dynamically
    $params = [];
    $types = '';

    if (!empty($nama_kandidat)) {
        $params[] = "%" . $nama_kandidat . "%";
        $types .= 's';
    }
    if (!empty($nama_kelas)) {
        $params[] = "%" . $nama_kelas . "%";
        $types .= 's';
    }

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
            $output .= "<tr class='hover:bg-gray-50'>
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
        $output = "<tr><td colspan='7' class='px-6 py-4 text-xl text-gray-700 text-center'>Belum ada data pemilihan</td></tr>";
    }
    echo $output;
    exit;
}

// Fetch unique candidates
// $sql_kandidat = "SELECT DISTINCT nama_calon FROM t_kandidat";
// $stmt = $con->prepare($sql_kandidat);
// $stmt->execute();
// $result_kandidat = $stmt->get_result();

// // Fetch unique classes
// $sql_kelas = "SELECT DISTINCT nama_kelas FROM t_kandidat";
// $stmt = $con->prepare($sql_kelas);
// $stmt->execute();
// $result_kelas = $stmt->get_result();
// ?>

<div class="w-full">
    <div class="border rounded-xl p-4 shadow-inner shadow-gray-200 flex items-center justify-between">
        <h3 class="text-4xl font-semibold uppercase">History Pemilihan</h3>
        <div class="">
            <select name="filterKandidat" id="filter_kandidat" class="border px-4 py-3 rounded-xl outline-none">
                <option value="">-- Filter Kandidat --</option>
                <?php
                $stmt = $con->prepare("SELECT DISTINCT nama_calon FROM t_kandidat");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['nama_calon']}'>{$row['nama_calon']}</option>";
                }
                ?>
            </select>

            <select name="filterKelas" id="filter_kelas" class="border px-4 py-3 rounded-xl outline-none">
                <option value="">-- Filter Kelas --</option>
                <?php
                $stmt = $con->prepare("SELECT DISTINCT nama_kelas FROM t_history");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['nama_kelas']}'>{$row['nama_kelas']}</option>";
                }
                ?>
            </select>
            <button id="saveToCsv" class="bg-green-600 text-white px-4 py-3 rounded-lg">Export Excel</button>
        </div>
    </div>
    <div class="overflow-x-auto mt-8">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">No</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Token</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Nama Pemilih</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Kelas Pemilih</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Kandidat Terpilih</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Periode</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Data will be populated by AJAX -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function fetchHistory() {
            var kandidat = $("#filter_kandidat").val();
            var kelas = $("#filter_kelas").val();

            $.ajax({
                url: "fetch_history.php",
                type: "POST",
                data: {
                    nama_kandidat: kandidat,
                    nama_kelas: kelas
                },
                beforeSend: function() {
                    $('tbody').html("<tr><td colspan='7' class='px-6 py-4 text-xl text-gray-700 text-center'>Loading...</td></tr>");
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        }

        // Jalankan filter ketika dropdown berubah
        $("#filter_kandidat, #filter_kelas").on('change', fetchHistory);
    });
    
    $(document).ready(function () {
    $("#saveToCsv").on("click", function () {
        window.location.href = "export_csv_history.php";
    });
});

</script>