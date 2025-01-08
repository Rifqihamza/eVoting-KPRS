<?php
require('../include/connection.php');

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request'])) {
    $nama_kandidat = $_POST['request'];
    $history_sql = "SELECT nis, fullname, nama_calon, periode, timestamp FROM t_history";
    if (!empty($nama_kandidat)) {
        $history_sql .= " WHERE nama_calon LIKE ?";
        $stmt = $con->prepare($history_sql);
        $nama_kandidat_param = "%" . $nama_kandidat . "%";
        $stmt->bind_param('s', $nama_kandidat_param);
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
            $output .= "<tr class='hover:bg-gray-50'>
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
        $output = "<tr><td colspan='6' class='px-6 py-4 text-xl text-gray-700 text-center'>Belum ada data pemilihan</td></tr>";
    }
    echo $output;
    exit;
}

// Fetch all unique candidates for the dropdown
$sql = "SELECT DISTINCT nama_calon FROM t_kandidat";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="w-full">
    <div class="border rounded-xl p-4 shadow-inner shadow-gray-200">
        <div class="flex flex-row justify-between items-center">
            <h3 class="text-4xl font-semibold uppercase">History Pemilihan</h3>
            <select name="filter" id="filter" class="border px-4 py-2 rounded-xl outline-none">
                <option value="">-- Filter Kandidat --</option>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['nama_calon']}'>{$row['nama_calon']}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="overflow-x-auto mt-8">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">No</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Token</th>
                    <th class="px-6 py-3 text-left text-2xl font-semibold text-gray-600">Nama Pemilih</th>
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
        $("#filter").on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "fetch_history.php",
                type: "POST",
                data: { request: value },
                beforeSend: function() {
                    $('tbody').html("<tr><td colspan='6' class='px-6 py-4 text-xl text-gray-700 text-center'>Loading...</td></tr>");
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        });
    });
</script>
