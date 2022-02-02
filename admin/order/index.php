<?php

session_start();
$role = $_SESSION['dataUser']['role'];
require 'crudorder.php';

$order = query("SELECT * FROM tb_order INNER JOIN sub_layanan ON tb_order.nama_sub_layanan = sub_layanan.sub_layanan_id INNER JOIN layanan ON sub_layanan.layanan_id = layanan.layanan_id");

$modal = (isset($_GET['modal'])) ? $_GET['modal'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
$response = (isset($_GET['response'])) ? $_GET['response'] : NULL;
$hapus = (isset($_GET['hapus'])) ? $_GET['hapus'] : null;

if ($id != null) {
    $namalayanan = query("SELECT nama_layanan FROM layanan WHERE layanan_id = '$id'");
    $namalayanan = $namalayanan;
}
if ($response === "deletesuccess") {
    $response = "Data Orderan berhasil dihapus!";
} elseif ($response === "deletefalse") {
    $response = "Data Orderan gagal dihapus!";
}
// HAPUS LAYANAN
if ($hapus === "true") {
    if (delete($id) > 0) {
        echo "
			<script>
				document.location.href = './?response=deletesuccess';
			</script>
		";
    } else {
        echo "
			<script>
				document.location.href = './?response=deletefalse';
			</script>
		";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/utils.css">
    <title>Laundry | Data Layanan</title>
</head>

<body>
    <nav class="navbar">
        <span class="navbar-toggle" id="js-navbar-toggle">
            <i class="fas fa-bars"></i>
        </span>
        <a href="../" class="logo">Laundry</a>
        <ul class="main-nav" id="js-menu">
            <li>
                <a href="../" class="nav-links">Dashboard</a>
            </li>
            <li>
                <a href="" class="nav-links">Data Layanan</a>
            </li>
            <li>
                <a href="../harga" class="nav-links">Data Harga</a>
            </li>
            <li>
                <a href="../order" class="nav-links active">Data Orderan</a>
            </li>
            <li>
                <a href="../akun" class="nav-links">Data Akun</a>
            </li>
            <li>
                <a href="../../auth/logout" class="nav-links">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="section">
        <div class="container">
            <?php if (isset($response)) : ?>
                <div class="badge">
                    <a href="./" class="float-right font-black"><i class="fas fa-times"></i></a>
                    <strong><?= $response ?></strong>
                </div>
            <?php endif; ?>
            <div class="card">
                <form action="" method="post" class="float-right">

                    <input type="text" name="keyword" size="20" autofocus placeholder="Cari Orderan..." autocomplete="off" id="keyword">
                    <button type="submit" name="cari" id="tombol_cari">cari</button>

                </form>
                <div id="container">
                    <table class="table text-center mt-1">
                        <tr>
                            <th>No</th>
                            <th>Nama Induk Layanan</th>
                            <th>Nama SubLayanan</th>
                            <th>Harga</th>
                            <th>Tanggal Order</th>
                            <th>Alamat</th>
                            <th>Nama Pembeli</th>
                            <th>No telp Pembeli</th>
                            <th>Pesan / Keterangan</th>
                            <?php if ($role === '1') : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($order as $order) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $order['nama_layanan'] ?></td>
                                <td><?= $order['nama_sub_layanan'] ?></td>
                                <td>Rp.<?= $order['harga'] ?></td>
                                <td><?= $order['tanggal_order'] ?></td>
                                <td><?= $order['alamat'] ?></td>
                                <td><?= $order['nama'] ?></td>
                                <td><?= $order['telpon'] ?></td>
                                <td><?= $order['pesan'] ?></td>
                                <?php if ($role === '1') : ?>
                                    <td>
                                        <a href="?hapus=true&id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php if ($order === []) : ?>
                    <h1 class="text-center">Data kosong</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p> &copy; Copyright 2021</p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script>
        let mainNav = document.getElementById("js-menu");
        let navBarToggle = document.getElementById("js-navbar-toggle");

        navBarToggle.addEventListener("click", function() {
            mainNav.classList.toggle("active");
        });

        $(document).ready(function() {
            // hilangkan tombopl cari
            $("#tombol_cari").hide();

            // event ketika keyword ditulis
            $("#keyword").on("keyup", function() {
                let keyword = $('#keyword').val();
                $('#container').load(`datajax.php?keyword=${keyword}`);
            });
        });
    </script>
</body>

</html>