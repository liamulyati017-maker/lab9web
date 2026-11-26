<?php
$judul    = $judul ?? 'Library Function';
$sekarang = basename($_SERVER['SCRIPT_NAME']);
function menuAktif(string $file, string $sekarang): string
{
    return $file === $sekarang ? ' class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($judul); ?> - Library Function</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Latihan 2 - Library Function</h1>
        <p>Semua function dipanggil dari <code>helpers/functions.php</code></p>
    </header>
    <nav>
        <a href="index.php"<?= menuAktif('index.php', $sekarang); ?>>Beranda</a>
        <a href="toko.php"<?= menuAktif('toko.php', $sekarang); ?>>Toko</a>
        <a href="kontak.php"<?= menuAktif('kontak.php', $sekarang); ?>>Kontak</a>
        <a href="konversi.php"<?= menuAktif('konversi.php', $sekarang); ?>>Konversi &amp; Nilai</a>
    </nav>
    <main>
