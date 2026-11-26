<?php
require_once __DIR__ . '/helpers/functions.php';
$judul = 'Kontak';

$nama = $email = $pesan = '';
$error = '';
$sukses = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string) ($_POST['nama']  ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $pesan = trim((string) ($_POST['pesan'] ?? ''));

    if ($nama === '' || $pesan === '') {
        $error = 'Nama dan pesan wajib diisi.';
    } elseif (!validasiEmail($email)) {          // return true/false dipakai di kondisi
        $error = 'Format email tidak valid.';
    } else {
        $sukses = true;
    }
}
require_once __DIR__ . '/views/header.php';
?>
<section class="content">
    <h2>Hubungi Kami</h2>

    <?php if ($error): ?><p class="alert err"><?= e($error); ?></p><?php endif; ?>

    <?php if ($sukses): ?>
        <p class="alert ok">Terima kasih, <?= e($nama); ?>! Pesan Anda diterima.</p>
        <p>Ringkasan pesan: <em><?= e(ringkasTeks($pesan, 80)); ?></em></p>
    <?php endif; ?>

    <form method="post" action="kontak.php">
        <p><label>Nama<br><input type="text" name="nama" value="<?= e($nama); ?>"></label></p>
        <p><label>Email<br><input type="text" name="email" value="<?= e($email); ?>"></label></p>
        <p><label>Pesan<br><textarea name="pesan" rows="4" cols="40"><?= e($pesan); ?></textarea></label></p>
        <p><button type="submit">Kirim</button></p>
    </form>
</section>
<?php require_once __DIR__ . '/views/footer.php'; ?>
