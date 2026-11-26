<?php
/**
 * index.php = ROUTER (pintu masuk satu-satunya).
 * Contoh: index.php?page=produk/list
 */
// Output buffering: supaya status HTTP (404) masih bisa diubah oleh modul
// meskipun header.php sudah menulis HTML.
ob_start();

require_once __DIR__ . '/helpers/functions.php';

// WHITELIST rute: kunci = nilai parameter "page", isi = file yang boleh dimuat
$routes = [
    'home'          => ['file' => __DIR__ . '/views/home.php',           'title' => 'Home'],
    'tentang'       => ['file' => __DIR__ . '/views/tentang.php',        'title' => 'Tentang'],
    'kontak'        => ['file' => __DIR__ . '/views/kontak.php',         'title' => 'Kontak'],
    'produk/list'   => ['file' => __DIR__ . '/modules/produk/list.php',   'title' => 'Daftar Produk'],
    'produk/detail' => ['file' => __DIR__ . '/modules/produk/detail.php', 'title' => 'Detail Produk'],
    'tools/konversi'=> ['file' => __DIR__ . '/modules/tools/konversi.php','title' => 'Konversi Suhu'],
];

$page = $_GET['page'] ?? 'home';

// Validasi: harus string DAN terdaftar di whitelist (array / tipe lain -> 404)
if (!is_string($page) || $page === '' || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $page        = '404';
    $title       = 'Halaman tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $title       = $routes[$page]['title'];
    $contentFile = $routes[$page]['file'];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';

ob_end_flush();
