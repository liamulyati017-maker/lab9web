<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }

// Logout hanya lewat POST + token CSRF
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(url('dashboard'));
}
require_csrf(url('dashboard'));

unset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['nama']);
session_regenerate_id(true);
set_flash('success', 'Anda telah logout.');
redirect(url('auth/login'));
