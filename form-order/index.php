<?php

require './crudorder.php';

$response = (isset($_GET['response'])) ? $_GET['response'] : NULL;
$modal = (isset($_GET['modal'])) ? $_GET['modal'] : NULL;

$sub_layanan = query("SELECT * FROM sub_layanan");

// KONDISI FLASH MSG
if ($response === "ordersuccess") {
    $response = "Order berhasil!";
} elseif ($response === "orderfalse") {
    $response = "Order gagal! Nama Layanan harus di pilih";
} elseif ($response === "updatesuccess") {
    $response = "Data layanan berhasil diubah!";
} elseif ($response === "updatefalse") {
    $response = "Data layanan gagal diubah!";
} elseif ($response === "deletesuccess") {
    $response = "Data layanan berhasil dihapus!";
} elseif ($response === "deletefalse") {
    $response = "Data layanan gagal dihapus!";
}


// ORDER LOGIC
if (isset($_POST['order'])) {
    if (tambah($_POST) > 0) {
        $nama_layanan = $_POST["nama_layanan"];
        $id_layanan = explode('|', $nama_layanan)[0];
        $tgl_order = $_POST["tgl_order"];
        $alamat = $_POST["alamat"];
        $no_telpon = $_POST["no_telpon"];
        $harga =  explode('|', $nama_layanan)[1];
        $uang = $_POST['uang'];
        $kembalian = intval($uang) - intval($harga);
        $nama = $_POST["nama"];
        $pesan = $_POST["pesan"];
        $response = "Order berhasil!";
        $modal = "true";
    } else {
        $response = "Order gagal!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/utils.css">
    <link rel="stylesheet" href="./modal.css">
    <link rel="stylesheet" href="./invoice.css">
    <title>Laundry</title>
</head>

<body>
    <nav class="navbar">
        <span class="navbar-toggle" id="js-navbar-toggle">
            <i class="fas fa-bars"></i>
        </span>
        <a href="../" class="logo">Laundry</a>
        <ul class="main-nav" id="js-menu">
            <li>
                <a href="../" class="nav-links">Home</a>
            </li>
            <li>
                <a href="../layanan" class="nav-links">Layanan</a>
            </li>
            <li>
                <a href="../harga" class="nav-links">List Harga</a>
            </li>
            <li>
                <a href="./" class="nav-links active">Form Order</a>
            </li>
        </ul>
    </nav>

    <section class="section">
        <div class="container">
            <?php if (isset($response)) : ?>
                <div class="badge">
                    <a href="./" class="float-right font-black"><i class="fas fa-times"></i></a>
                    <strong><?= $response ?></strong>
                </div>
            <?php endif; ?>
            <div class="card">
                <?php if ($modal != "true") { ?>
                    <div class="form-group">
                        <form action="" method="POST">
                            <select name="nama_layanan" id="nama_layanan" required>
                                <option value="0">Pilih Layanan</option>
                                <?php foreach ($sub_layanan as $sub_layanan) : ?>
                                    <option value="<?= $sub_layanan['sub_layanan_id'] . '|' . $sub_layanan['harga'] ?>"><?= $sub_layanan['nama_sub_layanan'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <input type="text" name="harga" id="harga" class="input" disabled>

                            <input type="number" name="uang" id="uang" placeholder="Uang anda" class="input">

                            <input type="date" name="tgl_order" id="tgl_order" class="input" required>
                            <input type="text" name="alamat" id="alamat" class="input" placeholder="Alamat Lengkap" required>
                            <input type="text" name="nama" id="nama" class="input" placeholder="Nama Anda" required>
                            <input type="number" name="no_telpon" id="no_telpon" class="input" placeholder="No Telp. Anda" required>
                            <input type="text" name="pesan" id="pesan" class="input" placeholder="Catatan / Keterangan tambahan">
                            <input type="submit" name="order" value="Order" class="submit-input">
                        </form>
                    </div>
                <?php } elseif (isset($_POST)) { ?>
                    <div class="receipt">
                        <header class="receipt__header">
                            <p class="receipt__title">
                                Laundry
                            </p>
                            <p class="receipt__date"><?= $tgl_order ?></p>
                        </header>
                        <dl class="receipt__list">
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Nama Pembeli</dt>
                                <dd class="receipt__cost"><?= $nama ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Id Layanan</dt>
                                <dd class="receipt__cost"><?= $id_layanan ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">No telp</dt>
                                <dd class="receipt__cost"><?= $no_telpon ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Alamat</dt>
                                <dd class="receipt__cost"><?= $alamat ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Uang anda</dt>
                                <dd class="receipt__cost">Rp.<?= $uang ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Harga</dt>
                                <dd class="receipt__cost">Rp.<?= $harga ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Kembalian</dt>
                                <dd class="receipt__cost">Rp.<?= $kembalian ?></dd>
                            </div>
                            <div class="receipt__list-row">
                                <dt class="receipt__item">Pesan / Keterangan</dt>
                                <dd class="receipt__cost"><?= $pesan ?></dd>
                            </div>
                            <p class="btn btn-order print">Print</p>
                        </dl>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

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
        $('.print').on('click', ()=>{
            window.print();
        })

        let nama_layanan = $('#nama_layanan');
        nama_layanan.on('change', ()=>{
            let harga = nama_layanan.val().split('|')[1];
            $('#harga').val(harga)
        })
    </script>
</body>

</html>