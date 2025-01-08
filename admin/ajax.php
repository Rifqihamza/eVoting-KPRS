<?php
define("BASEPATH", dirname(__FILE__));
session_start();

if (!isset($_SESSION['id_admin'])) {
   header('location:./');
}

include('../include/connection.php');

if (isset($_POST['periode'])) {
   $periode = $_POST['periode'];
} else {
   $now     = date('Y');
   $dpn     = date('Y') + 1;
   $periode = $now . '/' . $dpn;
}

$get = $con->prepare("SELECT * FROM t_kandidat WHERE periode = ?");
$get->bind_param('s', $periode);
$get->execute();
$get->store_result();
$htg = $get->num_rows();

if ($htg > 0) {
?>
   <div class="row">
      <?php
      for ($i = 0; $i < $htg; $i++) {
         $get->bind_result($id, $nama, $foto, $visi, $misi, $suara, $per);
         $get->fetch();
      ?>
         <div class="col-md-3 ">
            <div class="thumbnail relative">
               <img class="kandidat" src="../assets/img/kandidat/<?php echo $foto; ?>">
               <div class="suara absolute top-1 left-0 text-white">
                  <span class="bg-indigo-800 px-4 py-2 rounded-br-lg"><?php echo $suara; ?> Suara</span>
               </div>
               <div class="caption">
                  <h4 class="font-semibold "><?php echo $nama; ?></h4>
                  <div id="actionBtn" class="flex flex-row justify-between items-center px-4 text-white mt-4">
                     <a href="?page=kandidat&action=edit&id=<?php echo $id; ?>" class="bg-green-800 px-4 py-1 rounded-lg duration-300 hover:bg-indigo-800 text-white">Edit</a>
                     <div class="w-[1px] h-6 bg-blue-800 rotate-180"></div>
                     <a href="?page=kandidat&action=view&id=<?php echo $id; ?>" class="bg-orange-300 px-4 py-1 rounded-lg duration-300 hover:bg-indigo-800 text-white">View</a>
                     <div class="w-[1px] h-6 bg-blue-800 rotate-180"></div>
                     <a href="?page=kandidat&action=hapus&id=<?php echo $id; ?>" class="bg-red-400 px-4 py-1 rounded-lg duration-300 hover:bg-indigo-800 text-white" onclick="return confirm('Yakin ingin menghapus kandidat ini ?')">Delete</a>
                  </div>
               </div>
            </div>
         </div>
      <?php
      }
      ?>
   </div>
<?php
} else {

   echo '<div class="medium-8 medium-offset-2" style="padding-top:60px;">
            <div class="warning callout" style="padding: 30px 20px; text-align: center; color:#545252;">
               <h4>Tidak ada kandidat</h4>
            </div>
         </div>';
}
?>