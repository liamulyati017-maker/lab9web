<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// Ringkasan data dari database ($conn dari config/database.php)
$res = mysqli_query($conn,
    'SELECT COUNT(*) AS jumlah, COALESCE(SUM(stok), 0) AS total_stok,
            COALESCE(SUM(harga_beli * stok), 0) AS nilai_aset
     FROM data_barang');
$ringkas = mysqli_fetch_assoc($res);
?>
<section>
    <h2>Dashboard</h2>
    <p>Aplikasi ini adalah hasil refactoring CRUD Praktikum 8 ke struktur modular.</p>

    <div class="cards">
        <div class="card">
            <span class="card-label">Jumlah Jenis Barang</span>
            <span class="card-value"><?= (int) $ringkas['jumlah']; ?></span>
        </div>
        <div class="card">
            <span class="card-label">Total Stok</span>
            <span class="card-value"><?= (int) $ringkas['total_stok']; ?></span>
        </div>
        <div class="card">
            <span class="card-label">Nilai Aset (harga beli x stok)</span>
            <span class="card-value"><?= e(formatRupiah($ringkas['nilai_aset'])); ?></span>
        </div>
    </div>

    <p><a class="btn" href="<?= e(url('barang/list')); ?>">Kelola Data Barang</a></p>
</section>
