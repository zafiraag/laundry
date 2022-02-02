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

function delete($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_order WHERE order_id = '$id' ");
    return mysqli_affected_rows($koneksi);
}
