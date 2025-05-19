<?php
session_start();

if (isset($_SESSION['id_admin'])) {
  header('location: ./dashboard.php');
}

if (isset($_POST['submit'])) {
  define('BASEPATH', dirname(__FILE__));
  include('../include/connection.php');

  $user = $_POST['username'];
  $pass = mysqli_real_escape_string($con, $_POST['pass']);

  if ($user == null || $pass == null) {
    echo '<script type="text/javascript">alert("Username / Password tidak boleh kosong");</script>';
  } else {
    $log = $con->prepare("SELECT * FROM t_admin WHERE username = ?") or die($con->error);
    $log->bind_param('s', $user);
    $log->execute();
    $log->store_result();
    $jml = $log->num_rows();
    $log->bind_result($id, $username, $fullname, $password);
    $log->fetch();

    if ($jml > 0) {
      if (password_verify($pass, $password)) {
        $_SESSION['id_admin'] = $id;
        $_SESSION['user'] = $fullname;

        header('location:./dashboard.php');
      } else {
        echo '<script type="text/javascript">alert("Password Salah");</script>';
      }
    } else {
      echo '<script type="text/javascript">alert("Username tidak dikenali");</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Voting | Login Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <!-- Render Background -->

  <div class="bgContainer"></div>
  <style>
    .bgContainer {
      background-image: url('../assets/img/batik_background.jpg');
      background-size: cover;
      background-position: center;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: -1;
      /* Pastikan elemen tetap terlihat di bawah konten lain */
    }
  </style>
  <img id="imgLogo" src="../assets/img/logo.png" alt="" class="mx-auto w-[10rem] mt-10">
  <div class="flex flex-row justify-between">
    <img class="fixed -left-44" src="../assets/img/awan_element.png" alt="">
    <img class="mirror-horizontal fixed -right-44" src="../assets/img/awan_element.png" alt="">
  </div>

  <div id="Login" class="container relative">
    <div class="fixed bottom-0 inset-x-0 bg-white backdrop-blur-md w-[20rem] sm:w-2/4 sm:h-[34rem] h-[33rem] p-4 mx-auto rounded-t-2xl shadow-inner shadow-gray-300">
      <div class="mx-auto w-full space-y-4">
        <div id="titleForm" class="text-center uppercase tracking-wide space-y-2 z-10">
          <h1 class="text-2xl font-extrabold text-white bg-red-800 px-2 py-3 rounded-xl">Komisi Pemilihan Raya Sekolah</h1>
          <p class="text-lg font-bold tracking-wide">Admin - <span class="text-red-800 font-bold">E Voting</span></p>
        </div>
        <form action="" method="post" class="container w-full flex flex-col space-y-2" autocomplete="off">
          <label for="username" class="text-black tracking-wide">Username</label>
          <input type="text" class="px-4 py-4 rounded-xl outline-none bg-[#e6d9c1] placeholder:text-gray-800 focus:[box-shadow:0_0_4px_1px_#777777] duration-300" placeholder="Username" name="username">

          <label for="password" class="text-black tracking-wide">Password</label>
          <input type="password" class="px-4 py-4 rounded-xl outline-none bg-[#e6d9c1] placeholder:text-gray-800 focus:[box-shadow:0_0_4px_1px_#777777] duration-300" placeholder="Password" name="pass">

          <div class="flex flex-row w-full gap-3 text-center">
            <button type="submit" name="submit" value="submit" class="mt-6 text-center w-full px-3 py-2 text-white bg-red-800 rounded-xl -translate-y-[10px] [box-shadow:0_10px_0_#c3ae95] active:[box-shadow:0_5px_0_#c3ae95] active:-translate-y-[5px] relative z-10">Sign In</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="w-full bg-gray-800 fixed bottom-0 flex flex-row items-center gap-1 sm:gap-2 z-50">
    <div id="titleSMK" class="bg-red-600 sm:w-52 w-38 font-bold uppercase italic tracking-wider px-2 py-1 text-white rounded-br-3xl">
      <p class="sm:text-sm text-[5px]">The Real</p>
      <p class="sm:text-sm text-[5px]">Vocational School</p>
    </div>
    <ul class="flex flex-row gap-2">
      <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
        <img src="../assets/img/yt_icon.png" alt="icon" class="w-4 sm:w-6">
        <a href="https://www.youtube.com/@SMKMitraIndustriMMOfficial" target="_blank">SMK Mitra Industri (Official)</a>
      </li>
      <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
        <img src="../assets/img/ig_icon.png" alt="icon" class="w-4 sm:w-6">
        <a href="https://www.instagram.com/mitra_industri/" target="_blank">Mitra Industri</a>
      </li>
      <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
        <img src="../assets/img/ig_icon.png" alt="icon" class="w-4 sm:w-6">
        <a href="https://www.instagram.com/osismitraindustri/">Osis Mitra Industri</a>
      </li>
      <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
        <img src="../assets/img/fb_icon.png" alt="icon" class="w-4 sm:w-6">
        <a href="https://www.facebook.com/SmkMitraIndustriMM2100/?locale=id_ID">SMK Mitra Industri</a>
      </li>
      <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
        <img src="../assets/img/web_icon.png" alt="icon" class="w-4 sm:w-6 bg-white rounded-full">
        <a href="https://smkind-mm2100.sch.id/" target="_blank">www.smkind-mm2100.sch.id</a>
      </li>
    </ul>
  </footer>
  <script src="../assets/js/jquery-2.2.3.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>