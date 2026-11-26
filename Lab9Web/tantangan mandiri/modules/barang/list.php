<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// READ: ambil semua data barang
$result = mysqli_query($conn, 'SELECT * FROM data_barang ORDER BY id_barang DESC');
?>
<section>
    <h2>Data Barang</h2>
    <p><a class="btn" href="<?= e(url('barang/add')); ?>">+ Tambah Barang</a></p>

    <div class="table-wrap">
    <table>
        <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td class="center">
                <?php if (!empty($row['gambar'])): ?>
                    <img src="<?= e(asset('uploads/' . rawurlencode($row['gambar']))); ?>" alt="<?= e($row['nama']); ?>">
                <?php else: ?>-<?php endif; ?>
            </td>
            <td><?= e($row['nama']); ?></td>
            <td><?= e($row['kategori']); ?></td>
            <td class="right"><?= e(formatRupiah($row['harga_beli'])); ?></td>
            <td class="right"><?= e(formatRupiah($row['harga_jual'])); ?></td>
            <td class="center"><?= (int) $row['stok']; ?></td>
            <td class="aksi">
                <a href="<?= e(url('barang/edit', ['id' => $row['id_barang']])); ?>">Ubah</a>
                <!-- Hapus memakai POST + token CSRF, bukan link GET -->
                <form method="post" action="<?= e(url('barang/delete')); ?>" class="inline"
                      data-confirm="Yakin mau hapus '<?= e($row['nama']); ?>'?">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= (int) $row['id_barang']; ?>">
                    <button type="submit" class="link-button danger">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr><td colspan="7" class="center">Belum ada data</td></tr>
        <?php endif; ?>
    </table>
    </div>
</section>
