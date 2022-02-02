<?php
session_start();
require 'authfunction.php';

// cek cokie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($koneksi, "SELECT username FROM tb_akun WHERE username = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['dataUser'] = $row;
    }
}

if (isset($_SESSION["login"])) {
    header("location: ../admin");
    exit;
}

// cek apakah tombol submit suda ditekan atau belum
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "admin" && $password === "123") {
        $result = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE username = 'admin' ");
        $row = mysqli_fetch_assoc($result);
        $_SESSION["login"] = true;
        $_SESSION['dataUser'] = $row;
    }

    $result = mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE username = '$username' ");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION['dataUser'] = $row;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookkie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }


            header("location: ../admin");
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="authstyle.css">
    <link rel="stylesheet" href="../styles/utils.css">
    <title>Laundry | Login</title>
</head>

<body id="bg-login">
    <div class="box-login">
        <h2>Login <i class="fas fa-sign-in-alt"></i></h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" class="input-control">
            <input type="password" name="password" placeholder="Password" class="input-control">
            <input type="checkbox" name="remember" id="remember">
            <label for="remeberme">Ingat saya</label>
            <input type="submit" name="login" value="Login" class="button mt-1">
        </form>
        <p>Tidak punya akun ? Register <a href="register" style="color: blue;">Disini</a></p>
        <p><a href="../" class="btn mt-1">Kembali</a></p>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
</body>

</html>