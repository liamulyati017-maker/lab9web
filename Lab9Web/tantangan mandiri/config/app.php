<?php
/**
 * config/app.php - pengaturan umum aplikasi
 */
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

define('APP_NAME', 'Aplikasi Data Barang');

// Tantangan 3: true = halaman modul barang/auth wajib login
define('REQUIRE_LOGIN', true);

// Tantangan 4: true = URL ringkas /barang/list (butuh .htaccess + mod_rewrite)
//              false = URL biasa index.php?page=barang/list
define('USE_PRETTY_URL', false);

// Folder tujuan upload gambar barang
define('UPLOAD_DIR', dirname(__DIR__) . '/assets/uploads');
define('UPLOAD_MAX_BYTES', 2 * 1024 * 1024);   // 2 MB

// Pilihan kategori (juga dipakai sebagai whitelist validasi)
define('KATEGORI_BARANG', ['Komputer', 'Elektronik', 'Hand Phone']);
