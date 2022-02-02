<?php
session_start();
$role = $_SESSION['dataUser']['role'];
require './crudorder.php';

$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : null;

$query = "SELECT * FROM tb_order INNER JOIN sub_layanan ON tb_order.nama_sub_layanan = sub_layanan.sub_layanan_id INNER JOIN layanan ON sub_layanan.layanan_id = layanan.layanan_id
				WHERE
			nama_layanan LIKE '%$keyword%' OR
			nama LIKE '%$keyword%' OR
			alamat LIKE '%$keyword%' OR
			pesan LIKE '%$keyword%' OR
			telpon LIKE '%$keyword%' OR
			harga LIKE '%$keyword%'
			";

$order = query($query);
?>

<table class="table text-center mt-1">
    <tr>
        <th>No</th>
        <th>Nama Induk Layanan</th>
        <th>Nama SubLayanan</th>
        <th>Harga</th>
        <th>Tanggal Order</th>
        <th>Alamat</th>
        <th>Nama Pembeli</th>
        <th>No telp Pembeli</th>
        <th>Pesan / Keterangan</th>
        <?php if ($role === '1') : ?>
            <th>Aksi</th>
        <?php endif; ?>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($order as $order) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $order['nama_layanan'] ?></td>
            <td><?= $order['nama_sub_layanan'] ?></td>
            <td>Rp.<?= $order['harga'] ?></td>
            <td><?= $order['tanggal_order'] ?></td>
            <td><?= $order['alamat'] ?></td>
            <td><?= $order['nama'] ?></td>
            <td><?= $order['telpon'] ?></td>
            <td><?= $order['pesan'] ?></td>
            <?php if ($role === '1') : ?>
                <td>
                    <a href="?hapus=true&id=<?= $order['order_id'] ?>" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
                </td>
            <?php endif; ?>
        </tr>
        <?php $i++ ?>
    <?php endforeach; ?>
</table>