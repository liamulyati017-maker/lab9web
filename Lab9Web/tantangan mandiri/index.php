<?php
/**
 * index.php = ROUTER (titik masuk aplikasi).
 * Contoh: index.php?page=barang/list
 * Alur: muat config & helper -> cek whitelist rute -> cek login -> header + konten + footer
 */
define('APP_RUNNING', true);   // penanda: file lain hanya boleh dimuat lewat index.php

ob_start();   // buffer output: redirect() & http_response_code() tetap bisa jalan setelah header.php menulis HTML

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/helpers/functions.php';

// Sesi (dipakai untuk login, pesan flash, token CSRF)
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

require_once __DIR__ . '/config/database.php';

// WHITELIST rute. 'auth' => true berarti wajib login (jika REQUIRE_LOGIN aktif)
$routes = [
    'dashboard'    => ['file' => __DIR__ . '/views/dashboard.php',       'title' => 'Dashboard',     'auth' => false],
    'barang/list'  => ['file' => __DIR__ . '/modules/barang/list.php',   'title' => 'Data Barang',   'auth' => true],
    'barang/add'   => ['file' => __DIR__ . '/modules/barang/add.php',    'title' => 'Tambah Barang', 'auth' => true],
    'barang/edit'  => ['file' => __DIR__ . '/modules/barang/edit.php',   'title' => 'Ubah Barang',   'auth' => true],
    'barang/delete'=> ['file' => __DIR__ . '/modules/barang/delete.php', 'title' => 'Hapus Barang',  'auth' => true],
    'auth/login'   => ['file' => __DIR__ . '/modules/auth/login.php',    'title' => 'Login',         'auth' => false],
    'auth/logout'  => ['file' => __DIR__ . '/modules/auth/logout.php',   'title' => 'Logout',        'auth' => false],
];

// Ambil nama halaman dari URL. Dengan URL rewrite, nilainya bisa berakhiran "/".
$page = $_GET['page'] ?? 'dashboard';
if (is_string($page)) {
    $page = trim($page, '/');
    if ($page === '') {
        $page = 'dashboard';
    }
}

// Validasi: harus string dan terdaftar. Selain itu -> 404.
// Input URL TIDAK PERNAH dipakai langsung sebagai path file.
if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $page        = '404';
    $title       = 'Halaman tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $title       = $routes[$page]['title'];
    $contentFile = $routes[$page]['file'];

    // Pembatasan akses: halaman tertentu hanya untuk pengguna yang sudah login
    if ($routes[$page]['auth'] && REQUIRE_LOGIN && !is_logged_in()) {
        set_flash('error', 'Silakan login terlebih dahulu.');
        redirect(url('auth/login'));
    }
}

try {
    require_once __DIR__ . '/views/header.php';
    require $contentFile;
    require_once __DIR__ . '/views/footer.php';
} catch (Throwable $e) {
    // Error tak terduga (mis. query gagal): catat di log, tampilkan halaman 500 yang aman
    error_log($e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
    while (ob_get_level() > 1) { ob_end_clean(); }
    ob_clean();
    http_response_code(500);
    $title = 'Terjadi kesalahan';
    include __DIR__ . '/views/header.php';
    include __DIR__ . '/views/500.php';
    include __DIR__ . '/views/footer.php';
}

ob_end_flush();
