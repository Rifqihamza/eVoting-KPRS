<?php
if (!isset($_SESSION['id_admin'])) {
      header('location: ../');
}
?>
<div class="row">
      <div class="border rounded-xl p-4 shadow-inner shadow-gray-200">
            <div class="flex flex-row justify-between items-center">
                  <h3 class="text-4xl font-semibold uppercase">Daftar Siswa</h3>
                  <a class="btn btn-primary" href="?page=user&action=tambah">Tambah Siswa</a>
            </div>
      </div>
      <div class="col-md-12 col-sm-12">
            <table class="table table-striped table-hover">
                  <thead>
                        <tr>
                              <th style="text-align:center;">#</th>
                              <th style="text-align:center;">Nama Siswa</th>
                              <th style="text-align:center">Kelas</th>
                              <th width="130px" style="text-align:center;">Jenis Kelamin</th>
                              <th width="200px" style="text-align:center;">Opsi</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                        require('../include/connection.php');

                        if (isset($_GET['hlm'])) {
                              $hlm = $_GET['hlm'];
                              $no  = (5 * $hlm) - 4;
                        } else {
                              $hlm = 1;
                              $no  = 1;
                        }
                        $start  = ($hlm - 1) * 5;

                        $sql = mysqli_query($con, "SELECT * FROM t_user JOIN t_kelas ON t_user.id_kelas = t_kelas.id_kelas LIMIT $start,5");

                        if (mysqli_num_rows($sql) > 0) {

                              $i = 1;
                              while ($data = mysqli_fetch_array($sql)) {
                        ?>
                                    <tr>
                                          <td style="text-align:center;vertical-align:middle;">
                                                <?php echo $no++; ?>
                                          </td>
                                          <td style="padding-left:25px;vertical-align:middle;">
                                                <?php echo $data['fullname']; ?>
                                          </td>
                                          <td style="text-align:center;vertical-align:middle;">
                                                <?php echo $data['nama_kelas']; ?>
                                          </td>
                                          <td style="text-align:center;vertical-align:middle;">
                                                <?php
                                                if ($data['jk'] == 'L') {
                                                      echo 'Laki - laki';
                                                } else {
                                                      echo 'Perempuan';
                                                }
                                                ?>
                                          </td>
                                          <td style="text-align:center;vertical-align:middle;">
                                                <a href="?page=user&action=edit&id=<?php echo $data['id_user']; ?>" class="btn btn-warning btn-sm">
                                                      Edit
                                                </a>
                                                <a href="?page=user&action=hapus&id=<?php echo $data['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus user ini ?');" class="btn btn-danger btn-sm">
                                                      Hapus
                                                </a>
                                          </td>
                                    </tr>
                        <?php
                              }
                        } else {

                              echo "<tr>
                              <td colspan='5' style='text-align:center;'><h4>Belum ada data</h4></td>
                        </tr>";
                        }
                        ?>
                  </tbody>
            </table>
            <?php
            echo '<ul class="pagination">';
            if ($hlm > 1) { //start if
                  $hlmn = $hlm - 1;
            ?>
                  <li class="waves-effect">
                        <a href="?page=user&hlm=<?php echo $hlmn; ?>">
                              <i class='fa fa-caret-left'></i> Prev
                        </a>
                  </li>
            <?php
            }            //end if $hlm > 1


            $hitung = mysqli_num_rows(mysqli_query($con, "SELECT * FROM t_user"));

            $total  = ceil($hitung / 5);
            for ($i = 1; $i <= $total; $i++) { //start for
            ?>
                  <li <?php if ($hlm != $i) {
                              echo 'class="waves-effect"';
                        } else {
                              echo 'class="active"';
                        } ?>>
                        <a href="?page=user&hlm=<?php echo $i; ?>">
                              <?php echo $i; ?>
                        </a>
                  </li>
            <?php
            } // end for

            if ($hlm < $total) { //start if $hlm < $total
                  $next = $hlm + 1;
            ?>
                  <li class="waves-effect">
                        <a href="?page=user&hlm=<?php echo $next; ?>">
                              Next <i class='fa fa-caret-right'></i>
                        </a>
                  </li>
            <?php
            }      //end if $hlm < $total

            echo '</ul>';      //end pagination
            ?>
      </div>
</div>