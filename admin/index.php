<?php

session_start();
$username = $_SESSION['dataUser']['username'];
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/login");
    exit;
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
    <title>Laundry | Dashboard</title>
</head>

<body>
    <nav class="navbar">
        <span class="navbar-toggle" id="js-navbar-toggle">
            <i class="fas fa-bars"></i>
        </span>
        <a href="" class="logo">Laundry</a>
        <ul class="main-nav" id="js-menu">
            <li>
                <a href="" class="nav-links active">Dashboard</a>
            </li>
            <li>
                <a href="layanan/" class="nav-links">Data Layanan</a>
            </li>
            <li>
                <a href="harga" class="nav-links">Data Harga</a>
            </li>
            <li>
                <a href="order" class="nav-links">Data Orderan</a>
            </li>
            <li>
                <a href="akun" class="nav-links">Data Akun</a>
            </li>
            <li>
                <a href="../auth/logout" class="nav-links">Logout</a>
            </li>
        </ul>
    </nav>

    <section class="section">
        <div class="container">
            <div class="card">
                <h2>Halo <?= $username ?> Selamat datang di Dashboard <i class="fas fa-fire"></i></h2>
            </div>
        </div>
    </section>

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