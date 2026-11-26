<?php
if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); }
// Variabel dari router: $page (rute aktif), $title (judul halaman)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title); ?> - <?= e(APP_NAME); ?></title>
    <link rel="stylesheet" href="<?= e(asset('css/style.css')); ?>">
    <script src="<?= e(asset('js/app.js')); ?>" defer></script>
</head>
<body>
<div class="container">
    <header>
        <h1><?= e(APP_NAME); ?></h1>
        <p>Praktikum 9 - PHP Modular (template, function, dan routing)</p>
    </header>

    <nav>
        <div class="menu">
            <a href="<?= e(url('dashboard')); ?>"<?= nav_active($page, 'dashboard'); ?>>Dashboard</a>
            <a href="<?= e(url('barang/list')); ?>"<?= nav_active($page, 'barang'); ?>>Data Barang</a>
        </div>
        <div class="menu menu-user">
            <?php if (is_logged_in()): ?>
                <span>Halo, <strong><?= e($_SESSION['nama'] ?? $_SESSION['username'] ?? ''); ?></strong></span>
                <form method="post" action="<?= e(url('auth/logout')); ?>" class="inline">
                    <?= csrf_field(); ?>
                    <button type="submit" class="link-button">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?= e(url('auth/login')); ?>"<?= nav_active($page, 'auth'); ?>>Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <?= render_flash(); ?>
