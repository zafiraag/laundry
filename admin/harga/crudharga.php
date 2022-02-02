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

function tambah($data)
{
    global $koneksi;
    $layanan_id = htmlspecialchars($data["layanan_id"]);
    $nama_sub_layanan = htmlspecialchars($data["nama_sub_layanan"]);
    $harga = htmlspecialchars($data["harga"]);

    if ($layanan_id != 0) {
        $query = "INSERT INTO `sub_layanan` VALUES ('','$layanan_id','$nama_sub_layanan','$harga')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}
function update($data)
{
    global $koneksi;
    $id = $data["id"];
    $nama_sub_layanan = htmlspecialchars($data["nama_sub_layanan"]);
    $harga = htmlspecialchars($data["harga"]);

    $query = "UPDATE `sub_layanan` SET `nama_sub_layanan`='$nama_sub_layanan',`harga`='$harga' WHERE sub_layanan_id = '$id'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function delete($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM sub_layanan WHERE sub_layanan_id = '$id' ");
    return mysqli_affected_rows($koneksi);
}
