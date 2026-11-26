<?php if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); } ?>
<section>
    <h2>404 - Halaman tidak ditemukan</h2>
    <p>Halaman yang diminta tidak tersedia.</p>
    <a href="<?= e(url('dashboard')); ?>">Kembali ke dashboard</a>
</section>
