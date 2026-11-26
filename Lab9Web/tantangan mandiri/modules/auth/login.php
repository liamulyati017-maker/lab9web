<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// Sudah login -> tidak perlu lihat form login
if (is_logged_in()) {
    redirect(url('barang/list'));
}

$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_csrf(url('auth/login'));

    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    $stmt = mysqli_prepare($conn, 'SELECT id_user, username, password, nama FROM users WHERE username = ?');
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    // password_verify membandingkan password dengan hash di database
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);          // cegah session fixation
        $_SESSION['user_id']  = (int) $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama']     = $user['nama'];
        set_flash('success', 'Login berhasil. Selamat datang, ' . $user['nama'] . '!');
        redirect(url('barang/list'));
    }
    // Pesan sengaja dibuat umum (tidak membocorkan apakah username ada atau tidak)
    set_flash('error', 'Username atau password salah.');
}
?>
<section>
    <h2>Login</h2>
    <form method="post" action="<?= e(url('auth/login')); ?>" class="form-login">
        <?= csrf_field(); ?>
        <div class="input">
            <label for="username">Username</label>
            <div><input type="text" id="username" name="username" value="<?= e($username); ?>" required autofocus></div>
        </div>
        <div class="input">
            <label for="password">Password</label>
            <div><input type="password" id="password" name="password" required></div>
        </div>
        <div class="submit"><button type="submit" class="btn">Login</button></div>
    </form>
    <p><small>Akun awal: <code>admin</code> / <code>admin123</code> (dari database.sql)</small></p>
</section>
