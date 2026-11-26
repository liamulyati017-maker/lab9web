<section class="content">
    <h2>Home</h2>
    <p>Selamat datang di latihan router. Coba buka rute-rute berikut:</p>
    <ul>
        <li><a href="<?= link_rute('tentang'); ?>">tentang</a></li>
        <li><a href="<?= link_rute('produk/list'); ?>">produk/list</a></li>
        <li><a href="<?= link_rute('produk/detail', ['id' => 1]); ?>">produk/detail&amp;id=1</a></li>
        <li><a href="<?= link_rute('tools/konversi'); ?>">tools/konversi</a></li>
        <li><a href="<?= link_rute('kontak'); ?>">kontak</a></li>
        <li><a href="index.php?page=admin/rahasia">admin/rahasia</a> (tidak terdaftar &rarr; 404)</li>
    </ul>
</section>
