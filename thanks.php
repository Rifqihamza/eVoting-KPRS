<?php
// defined('BASEPATH') or die("No Access Allowed");
?>
<div id="container" class="relative">
   <div class="absolute right-0 left-0 top-[8rem]">
      <div class="w-3/4 sm:w-1/4 mx-auto border p-4 rounded-xl backdrop-blur-md bg-white/2">
         <p class="absolute text-white bg-red-500 px-2 rounded-lg top-1 left-1 text-xs text-left">Alert!</p>
         <div class="text-white text-center w-full">
            <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png" class="w-1/2 mx-auto">
            <h2>Terima kasih atas partisipasi anda</h2>
            <p>Suara yang anda berikan menentukan masa depan sekolah</p>
            <button onclick="backHome()" class="bg-indigo-900 px-3 py-4 rounded-xl w-full mt-8 hover:bg-indigo-700 duration-300">Back To Home</button>
         </div>
      </div>
   </div>
</div>

<style>
   @keyframes pulseAnimate {
      0% {
         transform: scale(0);
      }

      50% {
         transform: scale(1.1);
      }

      100% {
         transform: scale(1);
      }
   }

   #container {
      animation: pulseAnimate 0.5s ease-in-out;
   }
</style>



<script>
   document.getElementById("backHomeBtn")

   function backHome() {
      window.location.href = "./"
   }
</script>