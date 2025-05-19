<?php
define("BASEPATH", dirname(__FILE__));
session_start();
if (!isset($_SESSION['siswa'])) {
   header('location:./index.php');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>E-Voting | SMK Mitra Industri MM2100</title>
   <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-gray-100">
   <?php include 'components/batik_background.php'; ?>

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
        <header class="w-full fixed top-0 z-50">
            <nav class="sm:py-4 sm:px-4 py-2 px-2 w-full bg-[#e8dac0]/70 rounded-b-xl shadow-md flex justify-between">
                <ul class="flex sm:flex-row flex-col gap-2 items-center">
                    <li>
                        <h1 class="text-center uppercase tracking-wide sm:text-sm text-xs font-extrabold text-white bg-red-600 sm:px-6 sm:py-4 px-5 py-3 rounded-xl">
                            Komisi Pemilihan Raya Sekolah
                        </h1>
                    </li>
                    <li class="flex-1 sm:flex-none">
                        <h2 class="sm:text-sm text-xs font-semibold uppercase">
                            Paslon Ketua & Wakil Ketua OSIS <br> Periode 
                            <span class="text-sm text-red-600">' . $periode . '</span>
                        </h2>
                    </li>
                </ul>
                <img src="assets/img/golput.png" class="object-contain sm:w-16 w-20 sm:hidden block">
                <img src="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png" class="w-12 h-12 mr-4 ring-2 ring-red-800 rounded-full sm:block hidden">
            </nav>
        </header>
        ';

      echo '<div class="min-h-screen pb-24 pt-28 flex flex-col items-center">';

      include 'components/awan_element.php';

      echo '<div class="flex flex-col sm:flex-row max-w-4xl mx-auto items-center justify-center gap-10 z-10">';

      for ($i = 1; $i <= $numb; $i++) {
         $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
         $sql->fetch();
   ?>
         <img src="assets/img/golput.png" class="sm:w-44 w-24 fixed right-[8rem] top-[5rem] sm:block hidden -z-40" alt="">
         <section class="flex flex-col items-center justify-center bg-[#d1a187] backdrop-blur rounded-xl px-4 py-5 hover:scale-105 transition duration-300 gap-4">
            <img src="assets/img/batik_background.jpg" class="absolute top-0 left-0 right-0 w-full h-full -z-10 p-1 rounded-xl object-cover">
            <a href="javascript:void(0);" onclick="confirmVote(<?php echo $id; ?>, '<?php echo $suara; ?>');" class="sm:w-[20rem] w-[15rem]">
               <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="sm:w-[300px] w-[200px] mx-auto rounded-md border-2 border-black">
            </a>
            <a href="detail.php?id=<?php echo $id; ?>" class="mb-3 text-center uppercase tracking-wider font-bold sm:w-[16rem] w-[12rem] px-3 py-2 text-white bg-[#d93022] rounded-xl shadow-[0_10px_0_#fff] active:shadow-[0_5px_0_#fff] active:translate-y-1 relative z-10">
               Details
            </a>
         </section>
   <?php
      }
      echo '</div>';
      echo '</div>';
   } else {
      echo '<div class="text-center mt-20 text-gray-800">
                  <h2 class="text-2xl font-semibold">Belum Ada Calon Ketua</h2>
                  <a href="logout.php" class="text-red-500 hover:text-red-700 transition">Kembali</a>
              </div>';
   }
   ?>


   <!-- Rotated Image -->
   <div class="fixed sm:-bottom-[2rem] sm:-left-[3rem] -bottom-[1rem] -left-[2rem] rotate-12">
      <img src="assets/img/kotak_element.png" class="boxPilih sm:w-1/2 w-[10rem]" alt="Rotated Vector">
   </div>
   <div class="fixed sm:-bottom-[2rem] sm:-right-[15rem] -bottom-[2rem] -right-[20rem] -rotate-12">
      <img src="assets/img/kertas_element.png" class="kertasPilih sm:w-2/3 w-1/2" alt="">
   </div>
   <?php include 'footer.php' ?>
   <script src="./assets/js/jquery.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      function logoutBtn() {
         window.location.href = "logout.php";
      }
   </script>
</body>

</html>