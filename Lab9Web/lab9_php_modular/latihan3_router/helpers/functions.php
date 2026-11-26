<?php
function e(string $nilai): string
{
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function ringkasTeks(string $teks, int $maks = 100): string
{
    $teks = trim(preg_replace('/\s+/', ' ', strip_tags($teks)));
    if (mb_strlen($teks) <= $maks) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $maks), " ,.;:-") . '...';
}

function konversiCelciusKeFahrenheit(float $c): float
{
    return ($c * 9 / 5) + 32;
}

// Membuat link ke sebuah rute: link('produk/detail', ['id' => 2]) -> index.php?page=produk/detail&id=2
function link_rute(string $page, array $params = []): string
{
    $url = 'index.php?page=' . $page;
    if ($params) {
        $url .= '&' . http_build_query($params);
    }
    return $url;
}

// Menandai menu aktif: aktif jika rute sama persis atau diawali "grup/"
function menu_aktif(string $sekarang, string $grup): string
{
    if ($sekarang === $grup || strpos($sekarang, $grup . '/') === 0) {
        return ' class="active"';
    }
    return '';
}

// Data produk statis (pengganti database untuk latihan router)
function dataProduk(): array
{
    return [
        1 => ['nama' => 'HP Samsung Android', 'harga' => 2400000,
              'deskripsi' => 'Smartphone Android layar AMOLED, kamera ganda, dan baterai tahan seharian.'],
        2 => ['nama' => 'HP Xiaomi Android', 'harga' => 1400000,
              'deskripsi' => 'Smartphone terjangkau dengan performa stabil dan pengisian daya cepat.'],
        3 => ['nama' => 'HP OPPO Android', 'harga' => 2300000,
              'deskripsi' => 'Smartphone tipis dengan kamera selfie tajam dan fitur fast charging.'],
    ];
}
