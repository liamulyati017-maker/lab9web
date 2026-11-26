<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// Nilai awal form
$form   = ['nama' => '', 'kategori' => KATEGORI_BARANG[0], 'harga_beli' => '', 'harga_jual' => '', 'stok' => ''];
$errors = [];

// CREATE: jalan kalau form dikirim (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_csrf(url('barang/add'));

    $hasil  = validasi_barang($_POST);
    $form   = $hasil['data'];
    $errors = $hasil['errors'];

    // Upload gambar hanya diproses kalau isian lain sudah valid (hindari file yatim)
    $gambar = null;
    if (!$errors) {
        $gambar = upload_gambar($_FILES['file_gambar'] ?? [], $errUpload);
        if ($errUpload) {
            $errors['gambar'] = $errUpload;
        }
    }

    if (!$errors) {
        $stmt = mysqli_prepare($conn,
            'INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) VALUES (?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sssiii',
            $form['kategori'], $form['nama'], $gambar, $form['harga_beli'], $form['harga_jual'], $form['stok']);
        mysqli_stmt_execute($stmt);

        set_flash('success', 'Barang "' . $form['nama'] . '" berhasil ditambahkan.');
        redirect(url('barang/list'));
    }
    set_flash('error', 'Data belum valid, periksa kembali isian form.');
}

$action = url('barang/add');
$tombol = 'Simpan';
?>
<section>
    <h2>Tambah Barang</h2>
    <?php require __DIR__ . '/_form.php'; ?>
</section>
