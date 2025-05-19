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

<?php define('BASEURL', 'http://localhost:8080/evoting'); ?>

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
      <iframe src="components/audio_frame.html" style="display:none;"></iframe>
      <?php include 'components/batik_background.php' ?>

      <!-- Time Closed -->
      <?php
      date_default_timezone_set('Asia/Jakarta');

      $currentHour = date('G');

      $startTime = 10; // Time Website Starting to Open
      $endTime = 22; // Time Website Starting to CLose
      if ($currentHour < $startTime || $currentHour >= $endTime) {
            // Jika di luar jangkauan, Pesan Alert akan muncul
            include 'components/closedAlert.php';
            exit();
      }
      ?>
      <!-- End Time Closed -->
      <!-- HTML -->
      <img id="imgLogo" src="assets/img/logo.png" alt="" class="mx-auto w-[10rem] mt-10">
      <?php include 'components/awan_element.php' ?>
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
      <?php include 'footer.php' ?>
      <script type="text/javascript" src="./assets/js/jquery-2.2.3.min.js"></script>
      <script type="text/javascript" src="./assets/js/jquery-cycle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>