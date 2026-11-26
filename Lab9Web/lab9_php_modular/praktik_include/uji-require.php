<?php
// Uji require: kalau pesan.php tidak ada -> FATAL ERROR, program berhenti.
echo "Sebelum pemanggilan<br>";
require __DIR__ . '/pesan.php';
echo "Sesudah pemanggilan<br>";
