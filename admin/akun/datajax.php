<?php
session_start();
$role = $_SESSION['dataUser']['role'];
require './crudakun.php';

$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : null;

$query = "SELECT * FROM tb_akun
				WHERE
			username LIKE '%$keyword%' OR
			role LIKE '%$keyword%' 
			";

$akun = query($query);
?>

<table class="table text-center mt-1">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Role</th>
        <?php if ($role === "1") : ?>
            <th>Aksi</th>
        <?php endif; ?>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($akun as $akun) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $akun['username'] ?></td>
            <td><?= $akun['role'] ?></td>
            <?php if ($role === '1') : ?>
                <td>
                    <a href="?modal=true&id=<?= $akun['id_akun'] ?>"><i class="fas fa-edit"></i></a> | <a href="?hapus=true&id=<?= $akun['id_akun'] ?>" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
                </td>
            <?php endif; ?>
        </tr>
        <?php $i++ ?>
    <?php endforeach; ?>
</table>
<?php if ($akun === []) : ?>
    <h1 class="text-center">Data kosong</h1>
<?php endif; ?>