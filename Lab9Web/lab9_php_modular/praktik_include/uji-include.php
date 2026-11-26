<?php
// Uji include: kalau pesan.php tidak ada -> hanya WARNING, program lanjut.
echo "Sebelum pemanggilan<br>";
include __DIR__ . '/pesan.php';
echo "Sesudah pemanggilan<br>";
