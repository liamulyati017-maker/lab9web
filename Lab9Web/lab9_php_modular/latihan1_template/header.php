<?php
// Template bersama: awal dokumen HTML + navigasi.
// Halaman bisa mengisi $judul sebelum memanggil file ini.
$judul    = $judul ?? 'Aplikasi PHP Modular';
$sekarang = basename($_SERVER['SCRIPT_NAME']);   // untuk menandai menu aktif
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?> - Aplikasi PHP Modular</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>Contoh pemisahan template dan konten</p>
    </header>
    <nav>
        <a href="home.php"   <?= $sekarang === 'home.php'   ? 'class="active"' : ''; ?>>Home</a>
        <a href="profil.php" <?= $sekarang === 'profil.php' ? 'class="active"' : ''; ?>>Profil</a>
        <a href="kontak.php" <?= $sekarang === 'kontak.php' ? 'class="active"' : ''; ?>>Kontak</a>
    </nav>
    <main>
