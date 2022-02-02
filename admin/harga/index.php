<?php

session_start();
$role = $_SESSION['dataUser']['role'];
require 'crudharga.php';

$layanan = query("SELECT * FROM layanan");

$modal = (isset($_GET['modal'])) ? $_GET['modal'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
$response = (isset($_GET['response'])) ? $_GET['response'] : NULL;
$hapus = (isset($_GET['hapus'])) ? $_GET['hapus'] : null;


// KONDISI FLASH MSG
if ($response === "addsuccess") {
    $response = "Data sub Layanan berhasil ditambah!";
} elseif ($response === "addfalse") {
    $response = "Data sub Layanan gagal ditambah!";
} elseif ($response === "updatesuccess") {
    $response = "Data sub Layanan berhasil diubah!";
} elseif ($response === "updatefalse") {
    $response = "Data sub Layanan gagal diubah!";
} elseif ($response === "deletesuccess") {
    $response = "Data sub Layanan berhasil dihapus!";
} elseif ($response === "deletefalse") {
    $response = "Data sub Layanan gagal dihapus!";
}

if (isset($_POST['tambah-sublayanan'])) {
    if (tambah($_POST) > 0) {
        echo "
            <script>
                document.location.href = './?response=addsuccess';
            </script>
            ";
    } else {
        echo "
            <script>
                document.location.href = './?response=addfalse';
            </script>
            ";
    }
}

// UPDATE
if (isset($_POST['update-sublayanan'])) {
    if (update($_POST) > 0) {
        echo "
			<script>
				document.location.href = './?response=updatesuccess';
			</script>
		";
    } else {
        echo "
			<script>
				document.location.href = './?response=updatefalse';
			</script>
		";
    }
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
    <link rel="stylesheet" href="./modal.css">
    <title>Laundry | Data Harga</title>
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
                <a href="../layanan/" class="nav-links">Data Layanan</a>
            </li>
            <li>
                <a href="" class="nav-links active">Data Harga</a>
            </li>
            <li>
                <a href="../order" class="nav-links">Data Orderan</a>
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
            <?php if ($role === '1') : ?>
                <a href="?modal=true"><i class="fas fa-plus"></i> Tambah sub Layanan</a>
            <?php endif; ?>
            <?php if (isset($response)) : ?>
                <div class="badge">
                    <a href="./" class="float-right font-black"><i class="fas fa-times"></i></a>
                    <strong><?= $response ?></strong>
                </div>
            <?php endif; ?>
            <form action="" method="post" class="float-right">

                <input type="text" name="keyword" size="20" autofocus placeholder="Cari Sublayanan..." autocomplete="off" id="keyword">
                <button type="submit" name="cari" id="tombol_cari">cari</button>

            </form>
        </div>
        <div id="container">
            <div class="container" style="display: grid; grid-template-columns: repeat(2,1fr);">
                <?php foreach ($layanan as $layanan) : ?>
                    <?php $layanan_id = $layanan['layanan_id']; ?>
                    <div class="card">
                        <h3><?= $layanan['nama_layanan'] ?></h3>
                        <table class="table text-center">
                            <tr>
                                <th>No</th>
                                <th>Sub Layanan</th>
                                <th>Harga</th>
                                <?php if ($role === '1') : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                            <?php $i = 1; ?>
                            <?php
                            $sub_layanan = query("SELECT * FROM sub_layanan WHERE layanan_id = '$layanan_id'");
                            ?>
                            <?php foreach ($sub_layanan as $sub_layanan) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $sub_layanan['nama_sub_layanan'] ?></td>
                                    <td>Rp.<?= $sub_layanan['harga'] ?></td>
                                    <?php if ($role === '1') : ?>
                                        <td>
                                            <a href="?modal=true&id=<?= $sub_layanan['sub_layanan_id'] ?>"><i class="fas fa-edit"></i></a> | <a href="?hapus=true&id=<?= $sub_layanan['sub_layanan_id'] ?>" onclick="return confirm('yakin ?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </table>
                        <?php if ($sub_layanan === []) : ?>
                            <h2 class="text-center">Sub Layanan kosong</h2>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php if ($layanan === []) : ?>
                    <h2 class="text-center">Data kosong</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- tambah sublayanan -->
    <?php if ($modal === "true") :  ?>
        <?php if ($id === null) : ?>
            <?php $layanan = query("SELECT * FROM layanan"); ?>
            <div class="modal-overlay open-modal">
                <div class="modal-container">
                    <div class="content" style="display: inline-block">
                        <!-- CONTENT -->
                        <div class="form-group">
                            <form action="" method="POST">
                                <select name="layanan_id" id="layanan_id">
                                    <option value="0">Layanan</option>
                                    <?php foreach ($layanan as $layanan) : ?>
                                        <option value="<?= $layanan['layanan_id'] ?>"><?= $layanan['nama_layanan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" name="nama_sub_layanan" id="nama_sub_layanan" class="input" placeholder="Nama Sub layanan">
                                <input type="number" name="harga" id="harga" class="input" placeholder="Harga">
                                <input type="submit" name="tambah-sublayanan" value="Tambah" class="submit-input">
                            </form>
                        </div>
                        <!-- CONTENT END -->
                    </div>
                    <a href="./" class="close-btn"><i class="fas fa-times"></i></a>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- FORM EDIT LAYANAN -->
    <?php if ($modal === "true") : ?>
        <?php if ($id != null) : ?>
            <?php $sub_layanan = query("SELECT * FROM sub_layanan WHERE sub_layanan_id = '$id'")[0]; ?>
            <div class="modal-overlay open-modal">
                <div class="modal-container">
                    <div class="content" style="display: inline-block">
                        <!-- CONTENT -->
                        <div class="form-group">
                            <form action="" method="POST">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <input type="text" name="nama_sub_layanan" id="nama_sub_layanan" class="input" value="<?= $sub_layanan['nama_sub_layanan'] ?>">
                                <input type="number" name="harga" id="harga" class="input" value="<?= $sub_layanan['harga'] ?>">
                                <input type="submit" name="update-sublayanan" value="Submit" class="submit-input">
                            </form>
                        </div>
                        <!-- CONTENT END -->
                    </div>
                    <a href="./" class="close-btn"><i class="fas fa-times"></i></a>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

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