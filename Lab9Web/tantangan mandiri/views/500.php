<?php if (!defined('APP_RUNNING')) { http_response_code(403); exit('Akses langsung tidak diizinkan.'); } ?>
<section>
    <h2>500 - Terjadi kesalahan</h2>
    <p>Maaf, terjadi kesalahan pada server. Silakan coba lagi nanti.</p>
    <a href="<?= e(url('dashboard')); ?>">Kembali ke dashboard</a>
</section>
