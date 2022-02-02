<?php

$koneksi = mysqli_connect("localhost", "root", "", "db_laundry");


function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    if ($username === "admin" && $password === "123") {
        echo "<script>
				alert ('username sudah terdaftarr');
			</script>";
        return false;
    }

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM tb_akun WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert ('username sudah terdaftarr');
			</script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
				alert ('konfirmasi password tidak sesuai');
			</script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($koneksi, "INSERT INTO tb_akun VALUES('', '$username', '$password', DEFAULT)");

    return mysqli_affected_rows($koneksi);
}
