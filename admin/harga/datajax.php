<?php
session_start();
$role = $_SESSION['dataUser']['role'];
require './crudharga.php';

$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : null;

$query = "SELECT * FROM layanan
				WHERE
			nama_layanan LIKE '%$keyword%'
			";

$layanan = query($query);

if ($layanan === []) {
    $query = "SELECT * FROM sub_layanan
				WHERE
			nama_sub_layanan LIKE '%$keyword%'
			";

    $layanan = query($query);
}
?>

<div class="container" style="display: grid; grid-template-columns: repeat(2,1fr);">
    <?php foreach ($layanan as $layanan) : ?>
        <?php $layanan_id = $layanan['layanan_id']; ?>
        <div class="card">
            <?php if ($layanan === []) : ?>
                <h3><?= $layanan['nama_layanan'] ?></h3>
            <?php endif; ?>
            <table class="table text-center">
                <tr>
                    <th>No</th>
                    <th>Sub Layanan</th>
                    <th>Harga</th>
                    <?php if ($role === '1') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
                <?php $i = 1; ?>
                <?php
                $sub_layanan = query("SELECT * FROM sub_layanan WHERE layanan_id = '$layanan_id'");
                ?>
                <?php foreach ($sub_layanan as $sub_layanan) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $sub_layanan['nama_sub_layanan'] ?></td>
                        <td>Rp.<?= $sub_layanan['harga'] ?></td>
                        <?php if ($role === '1') : ?>
                            <td>
                                <a href="?modal=true&id=<?= $sub_layanan['sub_layanan_id'] ?>"><i class="fas fa-edit"></i></a> | <a href="?hapus=true&id=<?= $sub_layanan['sub_layanan_id'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </table>
            <?php if ($sub_layanan === []) : ?>
                <h2 class="text-center">Sub Layanan kosong</h2>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <?php if ($layanan === []) : ?>
        <h2 class="text-center">Data kosong</h2>
    <?php endif; ?>
</div>