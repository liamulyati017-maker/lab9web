<section class="content">
    <h2>Daftar Produk</h2>
    <div class="grid">
        <?php foreach (dataProduk() as $id => $p): ?>
        <div class="card">
            <h3><?= e($p['nama']); ?></h3>
            <p><?= e(ringkasTeks($p['deskripsi'], 45)); ?></p>
            <p><strong><?= formatRupiah($p['harga']); ?></strong></p>
            <a href="<?= link_rute('produk/detail', ['id' => $id]); ?>">Lihat detail</a>
        </div>
        <?php endforeach; ?>
    </div>
</section>
