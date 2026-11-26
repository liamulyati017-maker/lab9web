<?php
/**
 * helpers/functions.php - function umum yang dipakai banyak modul.
 * Dimuat sekali dengan require_once di index.php.
 */
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

/* ------------------------------------------------------------------ */
/* Tampilan & format                                                   */
/* ------------------------------------------------------------------ */

// Escaping output HTML
function e($nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

// 2400000 -> "Rp 2.400.000"
function formatRupiah($angka): string
{
    return 'Rp ' . number_format((float) $angka, 0, ',', '.');
}

/* ------------------------------------------------------------------ */
/* URL & routing                                                       */
/* ------------------------------------------------------------------ */

// Folder aplikasi di URL, mis. "/lab9_crud_modular" (tanpa slash di akhir)
function base_path(): string
{
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    return rtrim($dir, '/');
}

// Path absolut untuk aset: asset('css/style.css') -> /lab9_crud_modular/assets/css/style.css
// (path absolut membuat CSS tetap tampil walau URL berubah jadi /barang/list)
function asset(string $path): string
{
    return base_path() . '/assets/' . ltrim($path, '/');
}

// Membuat link ke sebuah rute. Mengikuti mode USE_PRETTY_URL.
//   url('barang/edit', ['id' => 3])
//   -> index.php?page=barang/edit&id=3   atau   /barang/edit?id=3
function url(string $page = 'dashboard', array $params = []): string
{
    $query = $params ? http_build_query($params) : '';
    if (USE_PRETTY_URL) {
        $u = base_path() . '/' . ($page === 'dashboard' ? '' : $page);
        return $query !== '' ? $u . '?' . $query : $u;
    }
    $u = base_path() . '/index.php?page=' . $page;
    return $query !== '' ? $u . '&' . $query : $u;
}

// Tantangan 1 - menu aktif: aktif jika rute sama persis atau satu grup ("barang" cocok "barang/add")
function nav_active(string $current, string $grup): string
{
    if ($current === $grup || strpos($current, $grup . '/') === 0) {
        return ' class="active"';
    }
    return '';
}

// Pindah halaman. Buffer dibuang dulu supaya header Location pasti terkirim.
function redirect(string $to)
{
    while (ob_get_level() > 0) { ob_end_clean(); }
    header('Location: ' . $to);
    exit;
}

/* ------------------------------------------------------------------ */
/* Tantangan 2 - pesan sukses / gagal (flash message)                  */
/* ------------------------------------------------------------------ */

// $type: success | error | info
function set_flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

// Ambil semua pesan lalu hapus (hanya tampil sekali)
function get_flash(): array
{
    $pesan = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $pesan;
}

// HTML siap pakai untuk menampilkan pesan
function render_flash(): string
{
    $html = '';
    foreach (get_flash() as $f) {
        $html .= '<div class="alert alert-' . e($f['type']) . '">' . e($f['message']) . '</div>';
    }
    return $html;
}

/* ------------------------------------------------------------------ */
/* Keamanan: CSRF                                                      */
/* ------------------------------------------------------------------ */

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Input hidden untuk ditaruh di setiap <form method="post">
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    $token = $_POST['csrf_token'] ?? '';
    return is_string($token)
        && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

// Hentikan proses jika token salah
function require_csrf(string $kembaliKe): void
{
    if (!csrf_valid()) {
        set_flash('error', 'Sesi formulir tidak valid atau kedaluwarsa. Silakan ulangi.');
        redirect($kembaliKe);
    }
}

/* ------------------------------------------------------------------ */
/* Tantangan 3 - autentikasi sederhana                                 */
/* ------------------------------------------------------------------ */

function is_logged_in(): bool
{
    return !empty($_SESSION['user_id']);
}

/* ------------------------------------------------------------------ */
/* Validasi & upload untuk modul barang                                */
/* ------------------------------------------------------------------ */

// Validasi input form barang. Return ['data' => [...], 'errors' => [field => pesan]]
function validasi_barang(array $in): array
{
    $errors = [];
    $data = [
        'nama'       => trim((string) ($in['nama'] ?? '')),
        'kategori'   => (string) ($in['kategori'] ?? ''),
        'harga_beli' => trim((string) ($in['harga_beli'] ?? '')),
        'harga_jual' => trim((string) ($in['harga_jual'] ?? '')),
        'stok'       => trim((string) ($in['stok'] ?? '')),
    ];

    if ($data['nama'] === '' || mb_strlen($data['nama']) > 50) {
        $errors['nama'] = 'Nama barang wajib diisi (maksimal 50 karakter).';
    }
    if (!in_array($data['kategori'], KATEGORI_BARANG, true)) {
        $errors['kategori'] = 'Kategori tidak valid.';
    }
    foreach (['harga_beli' => 'Harga beli', 'harga_jual' => 'Harga jual'] as $f => $label) {
        $v = filter_var($data[$f], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 9999999999]]);
        if ($v === false) {
            $errors[$f] = $label . ' harus berupa angka bulat 0 atau lebih.';
        } else {
            $data[$f] = $v;
        }
    }
    $stok = filter_var($data['stok'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 9999]]);
    if ($stok === false) {
        $errors['stok'] = 'Stok harus berupa angka bulat 0 - 9999.';
    } else {
        $data['stok'] = $stok;
    }

    return ['data' => $data, 'errors' => $errors];
}

// Upload gambar dengan aman. Return nama file baru, atau null (cek $error untuk alasan).
// Tipe file ditentukan dari ISI file (getimagesize), bukan dari nama/ekstensi bawaan pengguna.
function upload_gambar(array $file, &$error = null): ?string
{
    $error = null;
    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;                                   // tidak memilih file -> bukan error
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'Upload gambar gagal (kode ' . (int) $file['error'] . ').';
        return null;
    }
    if ($file['size'] > UPLOAD_MAX_BYTES) {
        $error = 'Ukuran gambar maksimal 2 MB.';
        return null;
    }
    $info = @getimagesize($file['tmp_name']);
    $ekstensi = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
    if ($info === false || !isset($ekstensi[$info['mime']])) {
        $error = 'File harus berupa gambar JPG, PNG, GIF, atau WEBP.';
        return null;
    }
    $nama = bin2hex(random_bytes(8)) . '.' . $ekstensi[$info['mime']];   // nama acak, tidak menimpa file lain
    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . '/' . $nama)) {
        $error = 'Gagal menyimpan file gambar.';
        return null;
    }
    return $nama;
}
