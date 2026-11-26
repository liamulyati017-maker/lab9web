<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// id selalu diambil dari URL (?id=...) dan dipaksa menjadi integer
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Ambil data lama
$data = null;
if ($id !== false && $id !== null) {
    $stmt = mysqli_prepare($conn, 'SELECT * FROM data_barang WHERE id_barang = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}
if (!$data) {
    set_flash('error', 'Data barang tidak ditemukan.');
    redirect(url('barang/list'));
}

$form = [
    'nama'       => $data['nama'],
    'kategori'   => $data['kategori'],
    'harga_beli' => (string) (int) $data['harga_beli'],
    'harga_jual' => (string) (int) $data['harga_jual'],
    'stok'       => (string) (int) $data['stok'],
];
$gambarLama = $data['gambar'];
$errors = [];
$action = url('barang/edit', ['id' => $id]);

// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_csrf($action);

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
        if ($gambar !== null) {
            // Ada gambar baru -> ikut diubah
            $stmt = mysqli_prepare($conn,
                'UPDATE data_barang SET kategori=?, nama=?, gambar=?, harga_beli=?, harga_jual=?, stok=? WHERE id_barang=?');
            mysqli_stmt_bind_param($stmt, 'sssiiii',
                $form['kategori'], $form['nama'], $gambar, $form['harga_beli'], $form['harga_jual'], $form['stok'], $id);
        } else {
            // Tidak ada gambar baru -> gambar lama dibiarkan
            $stmt = mysqli_prepare($conn,
                'UPDATE data_barang SET kategori=?, nama=?, harga_beli=?, harga_jual=?, stok=? WHERE id_barang=?');
            mysqli_stmt_bind_param($stmt, 'ssiiii',
                $form['kategori'], $form['nama'], $form['harga_beli'], $form['harga_jual'], $form['stok'], $id);
        }
        mysqli_stmt_execute($stmt);

        set_flash('success', 'Barang "' . $form['nama'] . '" berhasil diubah.');
        redirect(url('barang/list'));
    }
    set_flash('error', 'Data belum valid, periksa kembali isian form.');
}

$tombol = 'Simpan Perubahan';
?>
<section>
    <h2>Ubah Barang</h2>
    <?php require __DIR__ . '/_form.php'; ?>
</section>
