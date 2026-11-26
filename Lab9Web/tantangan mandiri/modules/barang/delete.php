<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// DELETE hanya boleh lewat POST (+ token CSRF). Membuka URL ini lewat GET tidak menghapus apa pun.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    set_flash('error', 'Penghapusan harus dilakukan lewat tombol Hapus.');
    redirect(url('barang/list'));
}
require_csrf(url('barang/list'));

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    set_flash('error', 'ID barang tidak valid.');
    redirect(url('barang/list'));
}

$stmt = mysqli_prepare($conn, 'DELETE FROM data_barang WHERE id_barang = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    set_flash('success', 'Barang berhasil dihapus.');
} else {
    set_flash('error', 'Data barang tidak ditemukan.');
}
redirect(url('barang/list'));
