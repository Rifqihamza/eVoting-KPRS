<?php
define("BASEPATH", dirname(__FILE__));
session_start();
if (!isset($_SESSION['siswa'])) {
   header('location:./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>E - Voting | SMK Mitra Industri MM2100</title>
   <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
   <link rel="stylesheet" href="assets/css/style.css">
   <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
   <canvas id="particleCanvas" class="absolute"></canvas>

   <?php
   require('./include/connection.php');

   $thn = date('Y');
   $dpn = date('Y') + 1;
   $periode = $thn . '/' . $dpn;

   $sql = $con->prepare("SELECT * FROM t_kandidat WHERE periode = ?") or die($con->error);
   $sql->bind_param('s', $periode);
   $sql->execute();
   $sql->store_result();

   if ($sql->num_rows() > 0) {
      $numb = $sql->num_rows();
      echo '
  <header class="w-full sticky-top z-50">
   <nav class="bg-indigo-800 px-6 py-4 border-b-2 rounded-b-xl [box-shadow:0_0_4px_2px_#fff]">
      <ul class="flex flex-row gap-3 items-center">
         <!-- Elemen pertama -->
         <li class="flex-1 sm:flex-none">
            <h1 class="bg-indigo-700 p-3 rounded-lg text-white font-bold text-center shadow-inner shadow-white text-xs sm:text-lg w-[13em] sm:w-full">
               <span class="">KOMISI PEMILIHAN</span>
               <span class=" text-orange-300">RAYA SEKOLAH</span>
            </h1>
         </li>
         <!-- Elemen kedua -->
         <li class="flex-1 sm:flex-none">
         <h2 class="text-sm text-white font-semibold">Kandidat Ketua & Wakil Ketua OSIS Periode <span class="text-sm text-orange-300">' . $periode . '</span></h2>
         </li>
      </ul>
   </nav>
</header>

';
      echo '<div class="flex flex-wrap items-center justify-center mx-auto flex-row mt-3 sm:mt-10 gap-4">';  // Added max-h-screen for scrolling

      for ($i = 1; $i <= $numb; $i++) {
         $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
         $sql->fetch();
   ?>

         <section data-wow-delay="<?php echo $i; ?>" class="mx-auto w-44 sm:w-[280px]">
            <div class="p-4 bg-indigo-800/30 backdrop-blur-md border border-gray-600 [box-shadow:0_0_4px_2px_#fff] rounded-lg flex flex-col items-center">
               <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="w-38 h-38 sm:w-48 sm:h-48 lg:w-72 lg:h-72 object-cover rounded-xl shadow-lg">
               <div id="title" class="text-white font-semibold mt-6 text-center">
                  <p class="text-sm lg:text-xl"><?php echo $nama; ?></p>
                  <div id="pilihBtn" class="flex justify-center gap-4 mt-4 text-md">
                     <a href="./detail.php?id=<?php echo $id; ?>" class="relative group">
                        Details
                        <span class="absolute rounded-full left-1/2 top-full h-1 w-0 bg-orange-300 transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                     </a>
                     <span class="inline-block w-[1px] bg-gray-200"></span>
                     <a href="./submit.php?id=<?php echo $id; ?>&s=<?php echo $suara; ?>" class="relative group">
                        Vote
                        <span class="absolute rounded-full left-1/2 top-full h-1 w-0 bg-orange-300 transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                     </a>
                  </div>
               </div>
            </div>
         </section>
   <?php
      }
      echo '</div>';
      echo '</div>';
   } else {
      echo '<div class="text-center mt-20 text-white">
               <h2 class="text-2xl font-semibold">Belum Ada Calon Ketua</h2>
               <a href="logout.php" class="text-orange-300 hover:text-orange-500 transition">Kembali</a>
            </div>';
   }
   ?>

   <footer>
      <img src="assets/img/wavegroup2.svg" class="rotate-180 absolute w-[150vw] h-auto bottom-0 right-0 left-0">
   </footer>
   <script src="./assets/js/jquery.js"></script>
   <script src="assets/js/pages/particlesBg.js"></script>
   <script>
      function logoutBtn() {
         window.location.href = "logout.php";
      }
   </script>
</body>

</html>