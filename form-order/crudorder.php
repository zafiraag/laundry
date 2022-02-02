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
    $tgl_order = htmlspecialchars($data["tgl_order"]);
    $harga =  explode('|', $nama_layanan)[1];
    $uang = intval(htmlspecialchars($data["uang"]));
    $alamat = htmlspecialchars($data["alamat"]);
    $no_telpon = htmlspecialchars($data["no_telpon"]);
    $nama = htmlspecialchars($data["nama"]);
    $pesan = htmlspecialchars($data["pesan"]);

    if ($uang < $harga) {
        echo "<script>
            alert('uang tidak cukup, minimal uang pembayaran sekitar Rp.$harga')
        </script>";
        return false;
    }

    if ($nama_layanan != "0") {
        $query = "INSERT INTO `tb_order` VALUES ('','$nama_layanan','$tgl_order','$alamat','$nama','$no_telpon','$pesan')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    } else {
        echo "<script>
        document.location.href = './?response=orderfalse';
    </script>";
        return false;
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
