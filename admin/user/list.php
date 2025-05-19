<?php
if (!isset($_SESSION['id_admin'])) {
    header('location: ../');
}
?>
<div class="row">
    <div class="border rounded-xl p-4 shadow-inner shadow-gray-200 flex flex-row justify-between items-center">
        <h3 class="text-4xl font-semibold uppercase">Daftar Siswa</h3>
        <div class="flex flex-row gap-2 items-center px-2 py-1 rounded-xl">
            <!-- Form Filter -->
            <form method="GET" action="" class="px-4 py-2 rounded-xl">
                <input type="hidden" name="page" value="user">
                <div class="flex flex-row gap-4 items-center">
                    <select name="filter_kelas" class="bg-gray-200 px-8 py-2 rounded-xl hover:bg-gray-300 duration-300 text-black uppercase font-semibold tracking-wide">
                        <option value="">-- Pilih Kelas --</option>
                        <?php
                        $kelas_query = mysqli_query($con, "SELECT * FROM t_kelas");
                        while ($kelas = mysqli_fetch_array($kelas_query)) {
                            $selected = (isset($_GET['filter_kelas']) && $_GET['filter_kelas'] == $kelas['id_kelas']) ? 'selected' : '';
                            echo "<option value='{$kelas['id_kelas']}' {$selected}>{$kelas['nama_kelas']}</option>";
                        }
                        ?>
                    </select>
                    <input type="text" name="search" value="<?php echo $_GET['search'] ?? ''; ?>" 
                           placeholder="Cari Nama Siswa" 
                           class="bg-gray-200 px-8 py-2 rounded-xl hover:bg-gray-300 duration-300 text-black">
                    <button type="submit" class="bg-blue-500 px-8 py-2 rounded-xl hover:bg-gray-300 duration-300 text-white uppercase font-semibold tracking-wide">Filter</button>
                    <a href="?page=user" class="bg-yellow-600 px-8 py-2 rounded-xl hover:bg-gray-300 duration-300 text-white uppercase font-semibold tracking-wide">Reset</a>
                    <a class="bg-green-600 px-8 py-2 rounded-xl hover:bg-gray-300 duration-300 text-white uppercase font-semibold tracking-wide" href="?page=user&action=tambah">Tambah Siswa</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="text-align:center;">#</th>
                    <th style="text-align:center;">Nama Siswa</th>
                    <th style="text-align:center;">ID Kelas</th>
                    <th style="text-align:center;">Nama Kelas</th>
                    <th width="200px" style="text-align:center;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('../include/connection.php');

                // Handle Pagination
                if (isset($_GET['hlm'])) {
                    $hlm = $_GET['hlm'];
                    $no  = (5 * $hlm) - 4;
                } else {
                    $hlm = 1;
                    $no  = 1;
                }
                $start  = ($hlm - 1) * 5;

                // Filter Conditions
                $filter_kelas = isset($_GET['filter_kelas']) && $_GET['filter_kelas'] != '' ? "AND t_user.id_kelas = '{$_GET['filter_kelas']}'" : '';
                $search_query = isset($_GET['search']) && $_GET['search'] != '' ? "AND t_user.fullname LIKE '%{$_GET['search']}%'" : '';

                // Query with Filters
                $sql = mysqli_query($con, "SELECT * FROM t_user 
                                    JOIN t_kelas ON t_user.id_kelas = t_kelas.id_kelas 
                                    WHERE 1=1 $filter_kelas $search_query 
                                    LIMIT $start,5");

                if (mysqli_num_rows($sql) > 0) {
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
                                <?php echo $data['id_kelas']; ?>
                            </td>
                            <td style="text-align:center;vertical-align:middle;">
                                <?php echo $data['nama_kelas']; ?>
                            </td>
                            <td style="text-align:center;vertical-align:middle;">
                                <a href="?page=user&action=edit&id=<?php echo $data['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?page=user&action=hapus&id=<?php echo $data['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus user ini ?');" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'><h4>Belum ada data</h4></td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php
        echo '<ul class="pagination">';
        if ($hlm > 1) {
            $hlmn = $hlm - 1;
        ?>
            <li class="waves-effect">
                <a href="?page=user&hlm=<?php echo $hlmn; ?>&filter_kelas=<?php echo $_GET['filter_kelas'] ?? ''; ?>&search=<?php echo $_GET['search'] ?? ''; ?>">
                    <i class='fa fa-caret-left'></i> Prev
                </a>
            </li>
        <?php
        }

        $hitung = mysqli_num_rows(mysqli_query($con, "SELECT * FROM t_user WHERE 1=1 $filter_kelas $search_query"));
        $total  = ceil($hitung / 5);

        $start_page = max(1, $hlm - 5);
        $end_page = min($total, $hlm + 4);

        if (($end_page - $start_page) < 9) {
            if ($start_page == 1) {
                $end_page = min($total, $start_page + 9);
            } else if ($end_page == $total) {
                $start_page = max(1, $end_page - 9);
            }
        }

        for ($i = $start_page; $i <= $end_page; $i++) {
        ?>
            <li <?php echo $hlm != $i ? 'class="waves-effect"' : 'class="active"'; ?>>
                <a href="?page=user&hlm=<?php echo $i; ?>&filter_kelas=<?php echo $_GET['filter_kelas'] ?? ''; ?>&search=<?php echo $_GET['search'] ?? ''; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php
        }

        if ($hlm < $total) {
            $next = $hlm + 1;
        ?>
            <li class="waves-effect">
                <a href="?page=user&hlm=<?php echo $next; ?>&filter_kelas=<?php echo $_GET['filter_kelas'] ?? ''; ?>&search=<?php echo $_GET['search'] ?? ''; ?>">
                    Next <i class='fa fa-caret-right'></i>
                </a>
            </li>
        <?php
        }
        echo '</ul>';
        ?>
    </div>
</div>
