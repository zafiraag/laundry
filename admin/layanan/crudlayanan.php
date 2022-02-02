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
    $nama_layanan = htmlspecialchars($data["nama_layanan"]);

    $query = "INSERT INTO layanan
				VALUES
				('', '$nama_layanan')
			";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
function update($data)
{
    global $koneksi;
    $id = $data["id"];
    $nama_layanan = htmlspecialchars($data["nama_layanan"]);

    $query = "UPDATE `layanan` SET `nama_layanan`='$nama_layanan' WHERE layanan_id = '$id'
			";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function delete($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM `sub_layanan` WHERE layanan_id = '$id'");
    if (mysqli_affected_rows($koneksi) > 0) {
        mysqli_query($koneksi, "DELETE FROM layanan WHERE layanan_id = '$id'");
        return mysqli_affected_rows($koneksi);
    } else {
        mysqli_query($koneksi, "DELETE FROM layanan WHERE layanan_id = '$id'");
        return mysqli_affected_rows($koneksi);
    }
}
