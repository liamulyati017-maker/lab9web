<?php
require_once __DIR__ . '/helpers/functions.php';
$judul = 'Konversi & Nilai';
require_once __DIR__ . '/views/header.php';

$celcius = isset($_GET['c']) && is_numeric($_GET['c']) ? (float) $_GET['c'] : 37;
$nilai   = isset($_GET['n']) && is_numeric($_GET['n']) ? (float) $_GET['n'] : 78;
?>
<section class="content">
    <h2>Konversi Suhu &amp; Predikat Nilai</h2>
    <form method="get" action="konversi.php">
        <p><label>Suhu (&deg;C)
            <input type="text" name="c" value="<?= e((string) $celcius); ?>"></label></p>
        <p><label>Nilai (0-100)
            <input type="text" name="n" value="<?= e((string) $nilai); ?>"></label></p>
        <p><button type="submit">Hitung</button></p>
    </form>
    <table class="info">
        <tr><th>Suhu</th>
            <td><?= e((string) $celcius); ?>&deg;C = <?= e((string) konversiCelciusKeFahrenheit($celcius)); ?>&deg;F</td></tr>
        <tr><th>Nilai</th>
            <td><?= e((string) $nilai); ?> &rarr; <?= e(tentukanStatusNilai($nilai)); ?></td></tr>
    </table>
</section>
<?php require_once __DIR__ . '/views/footer.php'; ?>
