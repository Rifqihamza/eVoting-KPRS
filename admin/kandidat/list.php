<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>

<div class="border rounded-xl p-4 shadow-inner shadow-gray-200">
   <div class="flex flex-row justify-between items-center">
      <h3 class="text-4xl font-semibold uppercase">Daftar Kandidat</h3>
      <div id="btn" class="flex gap-4">
         <a class="btn btn-primary" href="?page=kandidat&action=tambah">Tambah Kandidat</a>
         <!-- <a class="btn btn-primary" href="">Reset Vote</a> -->

         <select id="periode" class="form-control">
            <option value="">-- Pilih Periode--</option>
            <?php
            for ($i = 16; $i < 30; $i++) {
               $k = $i + 1;
               echo '<option value="20' . $i . '/20' . $k . '">Periode 20' . $i . ' / 20' . $k . '</option>';
            }
            ?>
         </select>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-md-3">
   </div>
   <div style="clear:both"></div>
   <br />
   <div class="col-md-12">
      <div id="data">
      </div>
   </div>
</div>