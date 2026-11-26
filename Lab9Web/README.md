# Lab9Web — Praktikum 9: PHP Modular

**Nama:** (isi nama)  
**NIM:** (isi NIM)  
**Kelas:** (isi kelas)

## Deskripsi

Project ini merupakan hasil Praktikum 9 tentang modularisasi program PHP. Materi yang dikerjakan meliputi pengujian `include` dan `require`, pembuatan template multi-halaman, penggunaan library function, routing dengan whitelist, serta refactoring aplikasi CRUD menjadi struktur modular.

Modularisasi membagi program menjadi beberapa file atau modul berdasarkan tanggung jawabnya. Dengan cara ini, kode lebih teratur, dapat digunakan kembali, dan lebih mudah dirawat.

## Tujuan Praktikum

1. Memahami konsep dan manfaat modularisasi program PHP.
2. Membedakan `include`, `require`, `include_once`, dan `require_once`.
3. Membuat template `header` dan `footer` yang digunakan bersama oleh beberapa halaman.
4. Membuat dan menggunakan function dengan parameter dan nilai `return`.
5. Menyusun aplikasi menggunakan struktur direktori modular.
6. Membuat routing dengan parameter URL dan whitelist rute.
7. Menerapkan modularisasi pada aplikasi CRUD.

## Kebutuhan Perangkat

- XAMPP (Apache dan MySQL) atau Laragon.
- PHP 7.4 atau lebih baru.
- Browser.
- Visual Studio Code atau editor kode lainnya.
- phpMyAdmin untuk mengimpor database.
- `mod_rewrite` Apache dan `AllowOverride All` (opsional, untuk URL yang lebih ringkas).

## Struktur Direktori

```text
Lab9Web/
├── README.md
├── JAWABAN.md
├── screenshots/
├── lab9_php_modular/
│   ├── praktik_include/
│   │   ├── pesan.php
│   │   ├── uji-include.php
│   │   └── uji-require.php
│   ├── latihan1_template/
│   │   ├── header.php
│   │   ├── footer.php
│   │   ├── style.css
│   │   ├── home.php
│   │   ├── profil.php
│   │   └── kontak.php
│   ├── latihan2_function/
│   │   ├── helpers/functions.php
│   │   ├── views/header.php
│   │   ├── views/footer.php
│   │   ├── index.php
│   │   ├── toko.php
│   │   ├── kontak.php
│   │   ├── konversi.php
│   │   └── style.css
│   └── latihan3_router/
│       ├── index.php
│       ├── helpers/functions.php
│       ├── views/
│       └── modules/
│           ├── produk/
│           └── tools/
└── lab9_crud_modular/
    ├── index.php
    ├── .htaccess
    ├── database.sql
    ├── config/
    │   ├── app.php
    │   └── database.php
    ├── views/
    │   ├── header.php
    │   ├── footer.php
    │   ├── dashboard.php
    │   ├── 404.php
    │   └── 500.php
    ├── helpers/functions.php
    ├── modules/
    │   ├── barang/
    │   │   ├── list.php
    │   │   ├── add.php
    │   │   ├── edit.php
    │   │   ├── delete.php
    │   │   └── _form.php
    │   └── auth/
    │       ├── login.php
    │       └── logout.php
    └── assets/
        ├── css/style.css
        ├── js/app.js
        └── uploads/
```

### Fungsi Folder Utama

| Folder/File | Fungsi |
|---|---|
| `index.php` | Router atau titik masuk utama aplikasi. |
| `config/` | Menyimpan pengaturan aplikasi dan konfigurasi koneksi database. |
| `views/` | Menyimpan tampilan bersama seperti header, footer, dashboard, dan halaman error. |
| `helpers/` | Menyimpan function umum yang digunakan oleh beberapa bagian aplikasi. |
| `modules/` | Menyimpan fitur aplikasi, seperti pengelolaan barang dan autentikasi. |
| `assets/` | Menyimpan file CSS, JavaScript, dan gambar. |
| `database.sql` | Skrip untuk membuat database, tabel, dan data awal. |
| `JAWABAN.md` | Analisis dan jawaban pertanyaan pemahaman praktikum. |

## Cara Menjalankan Project

1. Ekstrak folder `Lab9Web` ke direktori web server, misalnya `C:\xampp\htdocs\`.
2. Buka XAMPP Control Panel.
3. Jalankan **Apache** dan **MySQL**.
4. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`.
5. Pilih menu **Import**, lalu impor file `lab9_crud_modular/database.sql`.
6. Pastikan pengaturan database di `lab9_crud_modular/config/database.php` sesuai dengan komputer yang digunakan.
7. Buka halaman praktikum melalui browser menggunakan URL berikut.

| Bagian Praktikum | URL |
|---|---|
| Pengujian include/require | `http://localhost/lab9_php_modular/praktik_include/uji-include.php` |
| Latihan 1 — Template | `http://localhost/lab9_php_modular/latihan1_template/home.php` |
| Latihan 2 — Function | `http://localhost/lab9_php_modular/latihan2_function/` |
| Latihan 3 — Router | `http://localhost/lab9_php_modular/latihan3_router/` |
| Latihan 4 — CRUD Modular | `http://localhost/lab9_crud_modular/` |

> URL di atas mengikuti nama folder pada struktur praktikum. Jika nama atau lokasi folder diubah, sesuaikan URL-nya.

## Akun Login CRUD

Akun awal yang disediakan pada skrip database:

- **Username:** `admin`
- **Password:** `admin123`

Password disimpan dalam bentuk hash pada tabel `users`. Ganti akun bawaan sebelum aplikasi digunakan di lingkungan nyata.

## Ringkasan Hasil Praktikum

### 1. Pengujian `include` dan `require`

File `uji-include.php` dan `uji-require.php` memanggil `pesan.php`.

- `include`: jika file tidak ditemukan, PHP memberikan warning dan proses program tetap berlanjut.
- `require`: jika file tidak ditemukan, PHP menghasilkan fatal error dan proses program berhenti.

### 2. Template Multi-Halaman

Halaman Home, Profil, dan Kontak menggunakan `header.php` dan `footer.php` yang sama. Pemisahan ini mengurangi pengulangan kode dan membuat tampilan antarhalaman konsisten.

### 3. Library Function

Function umum disimpan di `helpers/functions.php`, antara lain:

- `e()`
- `formatRupiah()`
- `hitungDiskon()`
- `hitungTotal()`
- `validasiEmail()`
- `ringkasTeks()`
- `konversiCelciusKeFahrenheit()`
- `tentukanStatusNilai()`

Function tersebut digunakan kembali pada halaman toko, kontak, dan konversi.

### 4. Router dengan Whitelist

`index.php` membaca parameter `page` dari URL dan mencocokkannya dengan daftar rute yang diizinkan. Jika rute tidak terdaftar atau input bukan string, aplikasi menampilkan halaman 404. Input URL tidak digunakan langsung sebagai path file.

### 5. Refactoring CRUD Modular

Aplikasi CRUD disusun menjadi bagian konfigurasi, tampilan, helper, dan modul. Modul `barang` menangani daftar, tambah, ubah, dan hapus data. Modul `auth` menangani login dan logout. Form tambah dan ubah menggunakan file partial `_form.php`.

## Fitur dan Pengamanan

- Routing menggunakan whitelist rute.
- Pembatasan akses halaman menggunakan sesi login.
- Password disimpan menggunakan `password_hash()` dan diperiksa dengan `password_verify()`.
- Penghapusan data menggunakan metode POST dan token CSRF.
- Validasi input dilakukan di sisi server.
- Query database menggunakan prepared statement.
- Output teks menggunakan helper `e()` untuk membantu mencegah XSS.
- Gambar upload diperiksa menggunakan `getimagesize()` dan disimpan dengan nama acak.
- Error teknis dicatat ke log server dan pengguna memperoleh halaman error yang aman.
- URL rewrite tersedia melalui `.htaccess` sebagai fitur opsional.

## Pengaturan Database dan URL

### Database

Pengaturan koneksi berada di:

```text
lab9_crud_modular/config/database.php
```

Konfigurasi bawaan:

- Host: `localhost`
- Username: `root`
- Password: kosong
- Database: `latihan1`

Sesuaikan nilai tersebut jika konfigurasi MySQL pada komputer berbeda.

### URL Rewrite (Opsional)

Untuk menggunakan URL seperti `/barang/list`:

1. Pastikan modul Apache `mod_rewrite` aktif.
2. Pastikan `AllowOverride All` di konfigurasi direktori Apache.
3. Restart Apache.
4. Pada `lab9_crud_modular/config/app.php`, ubah `USE_PRETTY_URL` menjadi `true`.

Jika konfigurasi rewrite belum tersedia, biarkan `USE_PRETTY_URL` bernilai `false` dan gunakan format URL `index.php?page=...`.

## Skenario Pengujian

Jalankan dan periksa skenario berikut pada komputer masing-masing:

- [ ] Halaman dashboard dapat dibuka.
- [ ] Pengguna yang belum login diarahkan ke halaman login saat membuka modul barang.
- [ ] Login dengan data benar berhasil.
- [ ] Login dengan data salah menampilkan pesan kesalahan.
- [ ] Data barang dapat ditambahkan.
- [ ] Data barang dapat diubah.
- [ ] Data barang dapat dihapus melalui POST.
- [ ] Permintaan hapus melalui GET tidak menghapus data.
- [ ] Rute yang tidak dikenal menampilkan halaman 404.
- [ ] Logout mengakhiri sesi pengguna.

**Catatan:** Checklist di atas merupakan skenario pengujian. Beri tanda centang setelah setiap pengujian benar-benar dilakukan. Simpan tangkapan layar hasil aktual pada folder `screenshots/`.

## Dokumentasi Tambahan

Lihat file [`JAWABAN.md`](JAWABAN.md) untuk analisis hasil praktik dan jawaban pertanyaan pemahaman.

## Identitas Repository

```text
Nama Project : Lab9Web
Praktikum    : Praktikum 9 — PHP Modular
Bahasa       : PHP
Database     : MySQL
```
