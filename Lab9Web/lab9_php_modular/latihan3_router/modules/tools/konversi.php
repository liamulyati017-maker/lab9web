<?php
$c = isset($_GET['c']) && is_numeric($_GET['c']) ? (float) $_GET['c'] : 37;
?>
<section class="content">
    <h2>Konversi Celcius ke Fahrenheit</h2>
    <form method="get" action="index.php">
        <input type="hidden" name="page" value="tools/konversi">
        <label>Suhu (&deg;C) <input type="text" name="c" value="<?= e((string) $c); ?>"></label>
        <button type="submit">Konversi</button>
    </form>
    <p><?= e((string) $c); ?>&deg;C = <strong><?= e((string) konversiCelciusKeFahrenheit($c)); ?>&deg;F</strong></p>
</section>
