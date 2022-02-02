<?php
session_start();

$role = $_SESSION['dataUser']['role'];
require 'crudakun.php';

$akun = query("SELECT * FROM tb_akun");

$modal = (isset($_GET['modal'])) ? $_GET['modal'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
$response = (isset($_GET['response'])) ? $_GET['response'] : NULL;
$hapus = (isset($_GET['hapus'])) ? $_GET['hapus'] : null;

if ($id != null) {
    $datakun = query("SELECT username, role FROM tb_akun WHERE id_akun = '$id'")[0];
    $username = $datakun['username'];
    $role = $datakun['role'];
}


// KONDISI FLASH MSG
if ($response === "updatesuccess") {
    $response = "Data akun berhasil diubah!";
} elseif ($response === "updatefalse") {
    $response = "Data akun gagal diubah!";
} elseif ($response === "deletesuccess") {
    $response = "Data akun berhasil dihapus!";
} elseif ($response === "deletefalse") {
    $response = "Data akun gagal dihapus!";
} elseif ($response === "deleteerror") {
    $response = "Username admin tidak bisa di hapus!";
}


// UPDATE LAYANAN
if (isset($_POST['update_akun'])) {
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
    $username = query("SELECT username FROM tb_akun WHERE id_akun = '$id'")[0]['username'];

    if ($username != "admin") {
        mysqli_query($koneksi, "DELETE FROM tb_akun WHERE id_akun = '$id'");
        if (mysqli_affected_rows($koneksi) > 0) {
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
    } else {
        echo "
			<script>
				document.location.href = './?response=deleteerror';
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
                <a href="" class="nav-links active">Data Layanan</a>
            </li>
            <li>
                <a href="../harga" class="nav-links">Data Harga</a>
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
            <?php if (isset($response)) : ?>
                <div class="badge">
                    <a href="./" class="float-right font-black"><i class="fas fa-times"></i></a>
                    <strong><?= $response ?></strong>
                </div>
            <?php endif; ?>
            <div class="card">
                <form action="" method="post" class="float-right">

                    <input type="text" name="keyword" size="20" autofocus placeholder="Cari layanan..." autocomplete="off" id="keyword">
                    <button type="submit" name="cari" id="tombol_cari">cari</button>

                </form>
                <div id="container">
                    <table class="table text-center mt-1">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <?php if ($role === "1") : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($akun as $akun) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $akun['username'] ?></td>
                                <td><?= $akun['role'] ?></td>
                                <?php if ($role === '1') : ?>
                                    <td>
                                        <a href="?modal=true&id=<?= $akun['id_akun'] ?>"><i class="fas fa-edit"></i></a> | <a href="?hapus=true&id=<?= $akun['id_akun'] ?>" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php if ($akun === []) : ?>
                    <h1 class="text-center">Data kosong</h1>
                <?php endif; ?>
            </div>

            <!-- FORM EDIT LAYANAN -->
            <?php if ($modal === "true") : ?>
                <?php if ($id != null) : ?>
                    <div class="card">
                        <div class="form-group">
                            <a style="float: right;" href="./"><i class="fas fa-times"></i></a>
                            <form action="" method="POST">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <input type="text" name="username" id="username" class="input" value="<?= $username ?>">
                                <input type="text" name="role" id="role" class="input" value="<?= $role ?>">
                                <input type="submit" name="update_akun" value="Submit" class="submit-input">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
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