<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }
/**
 * Form barang yang dipakai bersama oleh add.php dan edit.php.
 * Variabel yang dibutuhkan: $action, $form, $errors, $tombol, $gambarLama (opsional)
 */
$err = function (string $f) use ($errors) {
    return isset($errors[$f]) ? '<span class="field-error">' . e($errors[$f]) . '</span>' : '';
};
?>
<form method="post" action="<?= e($action); ?>" enctype="multipart/form-data" novalidate>
    <?= csrf_field(); ?>

    <div class="input">
        <label for="nama">Nama Barang</label>
        <div><input type="text" id="nama" name="nama" maxlength="50" value="<?= e($form['nama']); ?>" required>
        <?= $err('nama'); ?></div>
    </div>
    <div class="input">
        <label for="kategori">Kategori</label>
        <div>
            <select id="kategori" name="kategori">
                <?php foreach (KATEGORI_BARANG as $k): ?>
                <option value="<?= e($k); ?>"<?= $form['kategori'] === $k ? ' selected' : ''; ?>><?= e($k); ?></option>
                <?php endforeach; ?>
            </select>
            <?= $err('kategori'); ?>
        </div>
    </div>
    <div class="input">
        <label for="harga_beli">Harga Beli</label>
        <div><input type="text" id="harga_beli" name="harga_beli" inputmode="numeric" value="<?= e($form['harga_beli']); ?>">
        <?= $err('harga_beli'); ?></div>
    </div>
    <div class="input">
        <label for="harga_jual">Harga Jual</label>
        <div><input type="text" id="harga_jual" name="harga_jual" inputmode="numeric" value="<?= e($form['harga_jual']); ?>">
        <?= $err('harga_jual'); ?></div>
    </div>
    <div class="input">
        <label for="stok">Stok</label>
        <div><input type="text" id="stok" name="stok" inputmode="numeric" value="<?= e($form['stok']); ?>">
        <?= $err('stok'); ?></div>
    </div>
    <div class="input">
        <label for="file_gambar">File Gambar</label>
        <div>
            <?php if (!empty($gambarLama)): ?>
                <img class="preview" src="<?= e(asset('uploads/' . rawurlencode($gambarLama))); ?>" alt="Gambar saat ini"><br>
                <small>Kosongkan jika tidak ingin mengganti gambar.</small><br>
            <?php endif; ?>
            <input type="file" id="file_gambar" name="file_gambar" accept="image/*">
            <?= $err('gambar'); ?>
        </div>
    </div>
    <div class="submit">
        <button type="submit" class="btn"><?= e($tombol); ?></button>
        <a href="<?= e(url('barang/list')); ?>">Batal</a>
    </div>
</form>
