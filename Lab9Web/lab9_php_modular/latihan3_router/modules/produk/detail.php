<?php
// Parameter id juga divalidasi: harus bilangan bulat dan ada di data.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$semua = dataProduk();

if ($id === false || $id === null || !isset($semua[$id])):
    http_response_code(404);
?>
<section class="content">
    <h2>Produk tidak ditemukan</h2>
    <p class="alert err">Produk dengan id tersebut tidak ada.</p>
    <a href="<?= link_rute('produk/list'); ?>">Kembali ke daftar produk</a>
</section>
<?php else: $p = $semua[$id]; ?>
<section class="content">
    <h2><?= e($p['nama']); ?></h2>
    <p><?= e($p['deskripsi']); ?></p>
    <p>Harga: <strong><?= formatRupiah($p['harga']); ?></strong></p>
    <a href="<?= link_rute('produk/list'); ?>">&laquo; Kembali</a>
</section>
<?php endif; ?>
