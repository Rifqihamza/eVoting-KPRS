<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>
<div class="border rounded-xl p-4 shadow-inner shadow-gray-200">
   <div class="flex flex-row justify-between items-center">
      <h3 class="text-4xl font-semibold uppercase">Daftar Kelas</h3>
      <div id="btn" class="flex gap-4">
      <a class="btn btn-primary" href="?page=kelas&action=tambah">Tambah Kelas</a>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-md-12">
      <table class="table table-striped">
         <thead>
            <tr>
               <th width="80px" style="text-align:center;">#</th>
               <th style="text-align:center;">Nama Kelas</th>
               <th width="150px" style="text-align:center;">Jumlah Siswa</th>
               <th width="200px" style="text-align:center;">Opsi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            require('../include/connection.php');
            $sql = mysqli_query($con, "SELECT a.*, (SELECT COUNT(id_kelas) FROM t_user WHERE id_kelas = a.id_kelas) AS jumlah FROM t_kelas a ORDER BY a.id_kelas ASC");

            if (mysqli_num_rows($sql) > 0) {

               while ($data = mysqli_fetch_array($sql)) {
            ?>
                  <tr>
                     <td style="text-align:center; vertical-align:middle">
                        <?php echo $data['id_kelas']; ?>
                     </td>
                     <td style="text-align:center; vertical-align:middle">
                        <?php echo $data['nama_kelas']; ?>
                     </td>
                     <td style="text-align:center; vertical-align:middle">
                        <?php echo $data['jumlah']; ?> Siswa
                     </td>
                     <td style="text-align:center;">
                        <a href="?page=kelas&action=edit&id=<?php echo $data['id_kelas']; ?>" class="btn btn-warning btn-sm">
                           Edit
                        </a>
                        <a href="?page=kelas&action=hapus&id=<?php echo $data['id_kelas']; ?>" onclick="return confirm('Yakin ingin menghapus kelas ini ?');" class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                     </td>
                  </tr>
            <?php
               }
            } else {

               echo "<tr>
                        <td colspan='4' style='text-align:center;'><h4>Belum ada data</h4></td>
                     </tr>";
            }
            ?>
         </tbody>
      </table>
   </div>
</div>