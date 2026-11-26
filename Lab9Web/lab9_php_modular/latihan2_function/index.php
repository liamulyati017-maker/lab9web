<?php
require_once __DIR__ . '/helpers/functions.php';
$judul = 'Beranda';
require_once __DIR__ . '/views/header.php';

$deskripsi = 'Halaman ini adalah contoh penggunaan library function. Function umum seperti formatRupiah, hitungDiskon, validasiEmail, dan ringkasTeks tidak ditulis ulang di setiap halaman, tetapi disimpan sekali di helpers/functions.php lalu dimuat dengan require_once.';
?>
<section class="content">
    <h2>Beranda</h2>
    <p><?= e(ringkasTeks($deskripsi, 120)); ?></p>
    <ul>
        <li><a href="toko.php">Toko</a> - formatRupiah, hitungDiskon, hitungTotal, ringkasTeks</li>
        <li><a href="kontak.php">Kontak</a> - validasiEmail, e()</li>
        <li><a href="konversi.php">Konversi &amp; Nilai</a> - konversiCelciusKeFahrenheit, tentukanStatusNilai</li>
    </ul>
</section>
<?php require_once __DIR__ . '/views/footer.php'; ?>
