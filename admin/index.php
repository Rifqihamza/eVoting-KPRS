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

        $_SESSION['id_admin']   = $id;
        $_SESSION['user']       = $fullname;

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
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../assets/css/AdminLTE.min.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<divb>
  <canvas id="particleCanvas"></canvas>
  <!-- /.login-logo -->
  <div id="Login" class="absolute inset-0 flex justify-center items-center">
  <div class="w-3/4 sm:w-2/4 h-auto p-6 mx-auto border border-white/10 rounded-xl backdrop-blur-md bg-white/3 [box-shadow:0_0_4px_2px_#fff]">

      <!-- Logo Image -->
      <img fetchpriority="high" src="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png" class="py-4 w-36 h-auto mx-auto" alt="">

      <div class="mx-auto w-full space-y-4">
        <div id="title" class="text-center space-y-2 tracking-wider">
          <a class="sm:text-xl text-md font-bold text-white " href="./"><b>Admin - </b> <span class="text-orange-300">eVoting</span></a>
          <p class="text-white text-sm sm:text-md ">Login Terlebih Dahulu Ya!</p>
        </div>
        <form action="" method="post" class="container w-full flex flex-col space-y-4" autocomplete="off">
          <label for="username" class="text-white tracking-wide">Username</label>
          <input type="text" class="py-4 px-4 rounded-xl outline-none bg-white/10 border border-white/20 text-white focus:[box-shadow:0_0_4px_2px_#fff] duration-300" placeholder="Username" name="username">

          <label for="password" class="text-white tracking-wide">Password</label>
          <input type="password" class="py-4 px-4 rounded-xl outline-none bg-white/10 border border-white/20 text-white focus:[box-shadow:0_0_4px_2px_#fff] duration-300" placeholder="Password" name="pass">

          <!-- /.col -->
          <div class="flex flex-row w-full gap-3 text-center">
            <button type="submit" name="submit" value="submit" class="text-white w-full rounded-lg bg-white/5 border border-white/10 py-2 px-4 hover:[box-shadow:0_0_4px_2px_#fff] duration-300">Sign In</button>
          </div>

        </form>
      </div>


    </div>
  </div>


  <!-- jQuery 2.2.3 -->
  <script src="../assets/js/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/pages/particlesBg.js"></script>
  </body>

</html>