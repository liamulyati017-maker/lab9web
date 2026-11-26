<?php
require_once __DIR__ . '/helpers/functions.php';
$judul = 'Toko';
require_once __DIR__ . '/views/header.php';

$produk = [
    ['nama' => 'HP Samsung Android', 'harga' => 2400000, 'jumlah' => 2, 'diskon' => 10,
     'deskripsi' => 'Smartphone Android layar AMOLED, kamera ganda, baterai tahan seharian untuk kebutuhan harian maupun kuliah.'],
    ['nama' => 'HP Xiaomi Android', 'harga' => 1400000, 'jumlah' => 3, 'diskon' => 15,
     'deskripsi' => 'Smartphone terjangkau dengan performa stabil dan pengisian daya cepat.'],
    ['nama' => 'HP OPPO Android', 'harga' => 2300000, 'jumlah' => 1, 'diskon' => 5,
     'deskripsi' => 'Smartphone dengan desain tipis, kamera selfie tajam, dan fitur pengisian daya super cepat.'],
];
$totalBelanja = 0;
?>
<section class="content">
    <h2>Daftar Belanja</h2>
    <table class="info">
        <tr>
            <th>Produk</th><th>Deskripsi</th><th>Harga</th><th>Jumlah</th>
            <th>Diskon</th><th>Total</th>
        </tr>
        <?php foreach ($produk as $p):
            $subtotal = hitungTotal($p['harga'], $p['jumlah']);
            $diskon   = hitungDiskon($subtotal, $p['diskon']);   // nilai return dipakai lagi
            $akhir    = $subtotal - $diskon;
            $totalBelanja += $akhir;
        ?>
        <tr>
            <td><?= e($p['nama']); ?></td>
            <td><?= e(ringkasTeks($p['deskripsi'], 50)); ?></td>
            <td><?= formatRupiah($p['harga']); ?></td>
            <td><?= (int) $p['jumlah']; ?></td>
            <td><?= (int) $p['diskon']; ?>% (<?= formatRupiah($diskon); ?>)</td>
            <td><?= formatRupiah($akhir); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="5">Total Bayar</th>
            <th><?= formatRupiah($totalBelanja); ?></th>
        </tr>
    </table>
    <p>Contoh <code>hitungDiskon(200000)</code> (default 10%) = <?= formatRupiah(hitungDiskon(200000)); ?>;
       <code>hitungDiskon(200000, 15)</code> = <?= formatRupiah(hitungDiskon(200000, 15)); ?></p>
</section>
<?php require_once __DIR__ . '/views/footer.php'; ?>
