<div class="text-right">
   <button id="save-img" class="bg-indigo-900 text-white px-4 py-3 rounded-lg">Simpan Grafik</button>
   <button id="save-csv" class="bg-green-600 text-white px-4 py-3 rounded-lg">Export To Excel</button>
</div>
<div style="font-size:18px;">
   <canvas id="canvas"></canvas>
</div>

<script>
   document.getElementById('save-csv').addEventListener('click', function() {
      window.location.href = 'export_csv.php'; // Redirect to export script
   });
</script>