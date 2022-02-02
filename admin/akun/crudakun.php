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
function update($data)
{
    global $koneksi;
    $id = $data["id"];
    $username = htmlspecialchars($data["username"]);
    $role = htmlspecialchars($data["role"]);

    $query = "UPDATE `tb_akun` SET `username`='$username', `role`='$role' WHERE id_akun = '$id'
			";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}