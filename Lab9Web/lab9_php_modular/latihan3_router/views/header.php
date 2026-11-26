<?php
// $page  = rute yang sedang dibuka (dari index.php)
// $title = judul halaman (dari daftar rute)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title); ?> - Router Aman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Latihan 3 - Router Aman</h1>
        <p>Satu pintu masuk (<code>index.php</code>), halaman dipilih lewat parameter <code>page</code></p>
    </header>
    <nav>
        <a href="<?= link_rute('home'); ?>"<?= menu_aktif($page, 'home'); ?>>Home</a>
        <a href="<?= link_rute('tentang'); ?>"<?= menu_aktif($page, 'tentang'); ?>>Tentang</a>
        <a href="<?= link_rute('produk/list'); ?>"<?= menu_aktif($page, 'produk'); ?>>Produk</a>
        <a href="<?= link_rute('tools/konversi'); ?>"<?= menu_aktif($page, 'tools'); ?>>Konversi</a>
        <a href="<?= link_rute('kontak'); ?>"<?= menu_aktif($page, 'kontak'); ?>>Kontak</a>
    </nav>
    <main>
