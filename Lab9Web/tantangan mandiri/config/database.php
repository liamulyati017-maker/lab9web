<?php
/**
 * config/database.php - SATU-SATUNYA tempat koneksi database dibuat.
 * Memakai MySQLi (sama seperti Praktikum 8). Dimuat dengan require_once.
 */
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'latihan1';

// Error MySQLi dilempar sebagai exception supaya mudah ditangani
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $pass, $db);
    mysqli_set_charset($conn, 'utf8mb4');
} catch (mysqli_sql_exception $e) {
    // Detail error hanya ke log server, tidak ditampilkan ke pengguna
    error_log('Koneksi DB gagal: ' . $e->getMessage());
    while (ob_get_level() > 0) { ob_end_clean(); }
    http_response_code(500);
    exit('Terjadi kesalahan pada koneksi database.');
}
