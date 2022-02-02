<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/utils.css">
    <title>Laundry</title>
</head>

<body>
    <nav class="navbar">
        <span class="navbar-toggle" id="js-navbar-toggle">
            <i class="fas fa-bars"></i>
        </span>
        <a href="" class="logo">Laundry</a>
        <ul class="main-nav" id="js-menu">
            <li>
                <a href="" class="nav-links active">Home</a>
            </li>
            <li>
                <a href="layanan" class="nav-links">Layanan</a>
            </li>
            <li>
                <a href="harga" class="nav-links">List Harga</a>
            </li>
            <li>
                <a href="form-order" class="nav-links">Order</a>
            </li>
            <li>
                <a href="auth/login" class="nav-links">Login</a>
            </li>
        </ul>
    </nav>

    <div class="home">
        <div class="banner">
            <p class="desc">Laundry Kiloan & Jasa Cuci Karpet Kantor
                Antar Jemput
                Langsung door to door untuk daerah Bogor & sekitarnya.</p>
            <a href="form-order/" class="btn btn-order">Order sekarang</a>
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