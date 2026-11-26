<?php
/**
 * helpers/functions.php
 * Kumpulan function umum yang dipakai bersama oleh banyak halaman.
 * Selalu dimuat dengan require_once supaya tidak terdeklarasi dua kali.
 */

// Escaping output ke HTML (mencegah XSS)
function e(string $nilai): string
{
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

// 150000 -> "Rp 150.000"
function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Mengembalikan NOMINAL diskon (bukan harga akhir). Default diskon 10%.
function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga * ($persen / 100);
}

// Total belanja = harga satuan x jumlah
function hitungTotal(float $harga, int $jumlah): float
{
    return $harga * $jumlah;
}

// true jika format email valid
function validasiEmail(string $email): bool
{
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL) !== false;
}

// Memotong teks panjang, berusaha berhenti di batas kata, lalu menambah "..."
function ringkasTeks(string $teks, int $maks = 100): string
{
    $teks = trim(preg_replace('/\s+/', ' ', strip_tags($teks)));
    if (mb_strlen($teks) <= $maks) {
        return $teks;
    }
    $potong = mb_substr($teks, 0, $maks);
    $spasi  = mb_strrpos($potong, ' ');
    if ($spasi !== false && $spasi > $maks * 0.6) {
        $potong = mb_substr($potong, 0, $spasi);
    }
    return rtrim($potong, " ,.;:-") . '...';
}

// Rumus: F = (C x 9/5) + 32
function konversiCelciusKeFahrenheit(float $c): float
{
    return ($c * 9 / 5) + 32;
}

// Predikat nilai: A >= 85, B >= 70, C >= 55, D >= 40, selain itu E
function tentukanStatusNilai(float $nilai): string
{
    if ($nilai < 0 || $nilai > 100) {
        return 'Nilai tidak valid (harus 0-100)';
    }
    if ($nilai >= 85) return 'A (Sangat Baik)';
    if ($nilai >= 70) return 'B (Baik)';
    if ($nilai >= 55) return 'C (Cukup)';
    if ($nilai >= 40) return 'D (Kurang)';
    return 'E (Gagal)';
}
