<?php
define('BASEPATH', dirname(__FILE__));
session_start();

if (isset($_SESSION['siswa'])) {
      header('location:./vote.php');
}

if (isset($_POST['submit'])) {

      require('include/connection.php');

      $fullname = $_POST['fullname'];
      $nis     = $_POST['nis'];
      $thn     = date('Y');
      $dpn     = date('Y') + 1;
      $periode = $thn . '/' . $dpn;

      $cek = $con->prepare("SELECT * FROM t_pemilih WHERE nis = ? AND fullname = ? AND periode = ?") or die($con->error);
      $cek->bind_param('sss', $nis, $fullname, $periode);
      $cek->execute();
      $cek->store_result();

      if ($cek->num_rows() > 0) {

            echo '<script type="text/javascript">alert("Anda sudah memberikan suara");</script>';
      } else {

            $sql = $con->prepare("SELECT id_user, fullname, id_kelas, jk, pemilih FROM t_user WHERE id_user = ? AND fullname = ? AND pemilih = 'Y'") or die($con->error);
            $sql->bind_param('ss', $nis, $fullname);
            $sql->execute();
            $sql->store_result();

            if ($sql->num_rows() > 0) {
                  $sql->bind_result($id, $user, $kelas, $jk, $pemilih);
                  $sql->fetch();

                  $_SESSION['siswa'] = $id;

                  header('location:./vote.php');
            } else {

                  echo '<script type="text/javascript">alert("Anda tidak berhak memberikan suara");</script>';
            }
      }
}


?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>E - Voting | Login Page</title>
      <link rel="icon" href="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png">
      <link rel="stylesheet" href="assets/css/style.css">
      <script src="https://cdn.tailwindcss.com"></script>
</head>


<body>
      <canvas id="particleCanvas"></canvas>
      <div class="row">
            <div class="col-md-12">
                  <?php
                  if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                              case 'thanks':
                                    include('./thanks.php');
                                    break;

                              default:
                                    include('./form.php');
                                    break;
                        }
                  } else {
                        include('./form.php');
                  }
                  ?>
            </div>
      </div>
      </div>
      <script type="text/javascript" src="./assets/js/jquery-2.2.3.min.js"></script>
      <script type="text/javascript" src="./assets/js/jquery-cycle.min.js"></script>
      <!-- <script type="text/javascript">
            $(document).ready(function() {
                  $('#content-slider').cycle({
                        fx: 'fade',
                        speed: 1000,
                        timeout: 500
                  });
            });
      </script> -->
      <script src="assets/js/pages/particlesBg.js"></script>
</body>

</html>