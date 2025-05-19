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
   <header class="w-full ">
      <nav class="bg-[#e8dac0]/70 py-3 px-6 w-full rounded-b-xl shadow-md shadow-white sm:justify-center flex flex-row justify-between items-center gap-4">
         <h1 class="text-center uppercase tracking-wide space-y-2 z-10 text-sm font-extrabold text-white bg-red-600 px-2 py-3 rounded-xl sm:w-1/4 w-full ">Details Paslon</h1>
         <img src="assets/img/golput.png" class="z-10 sm:w-14 w-20 sm:hidden block" alt="">

      </nav>
   </header>

   <?php include 'components/batik_background.php' ?>
   <div class="w-full mx-auto m-4 px-4">
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
         <div class="bg-white/40 border border-white/10 shadow-md rounded-xl p-6 shadow-black relative">
            <div class="flex flex-col sm:flex-row gap-8 items-center sm:items-start">
               <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="w-40 sm:w-80 md:w-96 object-contain rounded-md border-2 border-black">
               <div class="w-full">
                  <h3 class="text-gray-600 tracking-wide font-semibold text-lg sm:text-3xl mb-1 sm:mb-6">Informasi Detail Paslon</h3>
                  <table class="table-auto w-full text-xs md:text-base text-left text-white font-semibold border-collapse border-spacing-0">
                     <tbody>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-red-600 text-center">Nama Paslon</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 text-black bg-[#e9dabf]"><?php echo $nama; ?></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-red-600 text-center">Visi</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 text-black bg-[#e9dabf]"><?php echo nl2br($visi); ?></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                           <td class="py-1 px-2 sm:py-3 sm:px-4 font-medium bg-red-600 text-center">Misi</td>
                           <td class="py-1 px-2 sm:py-3 sm:px-4 text-black bg-[#e9dabf]"><?php echo nl2br($misi); ?></td>
                        </tr>
                     </tbody>
                  </table>

                  <div class="flex flex-col sm:flex-row mt-2 sm:mt-8 gap-1 sm:gap-2 w-full">
                     <button onclick="backHome()" class="mt-6 text-center w-full px-3 py-2 text-white bg-red-600 rounded-xl -translate-y-[10px] [box-shadow:0_10px_0_#c3ae95] active:[box-shadow:0_5px_0_#c3ae95] active:-translate-y-[5px] relative z-10">Kembali</button>
                     <button href="javascript:void(0);" onclick="confirmVote(<?php echo $id; ?>, <?php echo $suara; ?>);" class="mt-6 text-center w-full px-3 py-2 text-white bg-red-600 rounded-xl -translate-y-[10px] [box-shadow:0_10px_0_#c3ae95] active:[box-shadow:0_5px_0_#c3ae95] active:-translate-y-[5px] relative z-10">Vote</button>
                  </div>
                  <img src="assets/img/golput.png" class="z-10 w-44 fixed bottom-6 right-10 sm:block hidden" alt="">
               </div>
            </div>
         </div>
      <?php
      } else {
         header('location: ./');
      }2
      ?>
   </div>
   <?php include 'footer.php' ?>
   <script>
      function backHome() {
         window.location.href = 'vote.php';
      }
   </script>

   <script src="assets/js/pages/particlesBg.js"></script>
</body>

</html>