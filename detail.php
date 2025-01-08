<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Details Profile</title>
   <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<canvas id="particleCanvas" class="absolute"></canvas>
   <header class="w-full">
      <nav class="bg-indigo-800 px-6 py-4 border-b-2 rounded-b-xl shadow-lg">
         <h1 class="text-center px-3 py-3 bg-indigo-700 w-full sm:w-2/3 lg:w-1/3 mx-auto rounded-xl shadow-inner shadow-white text-white text-md sm:text-xl font-semibold uppercase tracking-wider">
            Details <span class="text-orange-300">Candidate</span>
         </h1>
      </nav>
   </header>

   <div class="max-w-7xl mx-auto mt-10 px-4">
      <?php
      define('BASEPATH', dirname(__FILE__));
      session_start();

      if (!isset($_SESSION['siswa'])) {
         header('location:./');
      }

      if (isset($_GET['id'])) {
         require('./include/connection.php');

         $sql = $con->prepare("SELECT * FROM t_kandidat WHERE id_kandidat = ?") or die($con->error);
         $sql->bind_param('i', $_GET['id']);
         $sql->execute();
         $sql->store_result();
         $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
         $sql->fetch();
      ?>
         <div class="bg-white/10 backdrop-blur-sm border border-white/10 shadow-xl rounded-xl p-6">
            <div class="flex flex-col sm:flex-row gap-8 items-center sm:items-start">
               <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="w-40 sm:w-80 md:w-96 object-cover aspect-square rounded-xl">
               <div class="w-full">
                  <h3 class="text-white text-lg sm:text-3xl mb-1 sm:mb-6">Details Information</h3>
                  <table class="table-auto w-full text-xs md:text-base text-left text-gray-200 border-collapse border-spacing-0">
                     <tbody>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-gray-100/40">Nama Calon</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 bg-gray-100/10"><?php echo $nama; ?></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-gray-100/40">Visi</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 bg-gray-100/10"><?php echo nl2br($visi); ?></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-gray-100/40">Misi</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 bg-gray-100/10"><?php echo nl2br($misi); ?></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-gray-100/40">Total Perolehan Suara</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 bg-gray-100/10"><?php echo $suara; ?> Suara</td>
                        </tr>
                        <tr>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-gray-100/40">Periode Pencalonan</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 bg-gray-100/10"><?php echo $periode; ?></td>
                        </tr>
                     </tbody>
                  </table>

                  <div class="flex flex-col sm:flex-row gap-4 mt-2 sm:mt-8 text-center">
                     <button onclick="window.history.go(-1)" class="py-1 px-2 sm:py-3 sm:px-4 w-full rounded-xl hover:[box-shadow:0_0_4px_2px_#fff] duration-300 bg-indigo-700 text-white">Back</button>
                     <a href="./submit.php?id=<?php echo $id; ?>&s=<?php echo $suara; ?>" class="py-1 px-2 sm:py-3 sm:px-4 w-full rounded-xl hover:[box-shadow:0_0_4px_2px_#fff] duration-300 bg-orange-400 text-white">Vote</a>
                  </div>
               </div>
            </div>
         </div>
      <?php
      } else {
         header('location: ./');
      }
      ?>
   </div>

   <script src="assets/js/pages/particlesBg.js"></script>
</body>

</html>
