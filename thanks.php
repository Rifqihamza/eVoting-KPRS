<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Terima Kasih | E-Voting SMK Mitra Industri MM2100</title>
   <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="assets/css/style.css">

<body>
   <?php include 'components/batik_background.php' ?>
   <?php include 'components/awan_element.php' ?>
   <img src="assets/img/logo.png" class="w-2/12 mx-auto translate-y-3" alt="">
   <div class="flex flex-row justify-between">
      <img class="fixed -left-44" src="assets/img/awan_element.png" alt="">
      <img class="mirror-horizontal fixed -right-44" src="assets/img/awan_element.png" alt="">
   </div>
   <div id="containerMessage" class="container relative">
      <div class="fixed bottom-0 inset-x-0 bg-white backdrop-blur-md w-[20rem] sm:w-2/4 sm:h-[34rem] h-[33rem] p-4 mx-auto rounded-t-2xl shadow-inner shadow-gray-300">
         <img src="assets/img/batik_element.png" class="absolute left-0 top-0 opacity-50 w-full h-screen -z-50" alt="">
         <h1 class="bg-red-800 text-white uppercase tracking-wide font-bold text-center p-4 rounded-xl max-w-xs mx-auto">Berhasil Voting!</h1>
         <div id="title" class="mt-6 text-center font-semibold uppercase tracking-wide">
            <h1>Terimakasih Telah Memberikan Suaramu!</h1>
            <p>Jangan Lupa Tunjukkan Ini Ke Panitia Ya.</p>
         </div>
         <button onclick="backHome()" class="mt-10 text-center w-full px-3 py-2 text-white bg-red-800 rounded-xl -translate-y-[10px] [box-shadow:0_10px_0_#e9dabf] active:[box-shadow:0_5px_0_#e9dabf] active:-translate-y-[5px] relative z-10">OK!</button>
         <div class="fixed sm:-bottom-2 -bottom-6 sm:-left-28 -left-[4rem] rotate-6 -z-10">
            <img src="assets/img/kotak_element.png" class="sm:w-1/2 w-[10rem]" alt="">
         </div>
         <div class="fixed sm:-bottom-4 -bottom-12 sm:-right-80 -right-[23rem] -rotate-12 -z-10">
            <img src="assets/img/kertas_element.png" class="sm:w-2/3 w-1/2" alt="">
         </div>
      </div>
   </div>
<?php include 'footer.php' ?>
   <script>
      function backHome() {
         window.location.href = "logout.php";
      }
   </script>
</body>

</html>