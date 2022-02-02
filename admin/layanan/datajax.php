<?php
session_start();
$role = $_SESSION['dataUser']['role'];
require './crudlayanan.php';

$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : null;

$query = "SELECT * FROM layanan
				WHERE
			nama_layanan LIKE '%$keyword%'
			";

$layanan = query($query);
?>

<table class="table text-center mt-1">
    <tr>
        <th>No</th>
        <th>Layanan</th>
        <?php if ($role === "1") : ?>
            <th>Aksi</th>
        <?php endif; ?>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($layanan as $layanan) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $layanan['nama_layanan'] ?></td>
            <?php if ($role === '1') : ?>
                <td>
                    <a href="?modal=true&id=<?= $layanan['layanan_id'] ?>"><i class="fas fa-edit"></i></a> | <a href="?hapus=true&id=<?= $layanan['layanan_id'] ?>" onclick="return confirm('Jika anda hapus layanan, maka sub_layanan akan terhapus. Yakin ?')"><i class="fas fa-trash"></i></a>
                </td>
            <?php endif; ?>
        </tr>
        <?php $i++ ?>
    <?php endforeach; ?>
</table>