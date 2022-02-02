<?php

require './authfunction.php';

// KONDISI FLASH MSG
$response = (isset($_GET['response'])) ? $_GET['response'] : NULL;

if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
				alert('user berhasil ditambahkan');
			</script>";
    } else {
        echo "<script>
				alert('user gagal ditambahkan');
			</script>";
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
    <title>Laundry | Register</title>
</head>

<body id="bg-login">
    <div class="box-login">
        <h2>Register <i class="fas fa-sign-in-alt"></i></h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="New Username" class="input-control">
            <input type="password" name="password" placeholder="New Password" class="input-control">
            <input type="password" name="password2" placeholder="Confirm Password" class="input-control">
            <input type="submit" name="register" value="Register" class="button">
        </form>
        <p>Punya akun ? Login <a href="login" style="color: blue;">Disini</a></p>
        <p><a href="../" class="btn">Kembali</a></p>
    </div>
    <script src="https://kit.fontawesome.com/6d2ea823d0.js"></script>
</body>

</html>