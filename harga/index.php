<?php

require '../mainfunctions.php';

$layanan = query("SELECT * FROM layanan");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/utils.css">
    <title>Laundry | List Harga</title>
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
                <a href="../layanan/" class="nav-links">Layanan</a>
            </li>
            <li>
                <a href="" class="nav-links active">List Harga</a>
            </li>
            <li>
                <a href="../form-order" class="nav-links">Order</a>
            </li>
        </ul>
    </nav>

    <div class="section">
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
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p> &copy; Copyright 2021</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
    <script>
        let mainNav = document.getElementById("js-menu");
        let navBarToggle = document.getElementById("js-navbar-toggle");

        navBarToggle.addEventListener("click", function() {
            mainNav.classList.toggle("active");
        });
    </script>
</body>

</html>