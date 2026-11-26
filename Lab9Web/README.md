# Lab9Web — Praktikum 9: PHP Modular

**Nama:** (Lia Mulyati)  
**NIM:** (312510167)  
**Kelas:** (I251D)

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

  ## Pertanyaan Pemahaman
1. Jelaskan pengertian modularisasi program dan minimal tiga manfaatnya. 
Modularisasi program adalah teknik membagi program menjadi beberapa bagian kecil atau modul berdasarkan fungsi dan tanggung jawab masing-masing agar kode lebih terstruktur.
Manfaat modularisasi:
- Mengurangi pengulangan kode, karena bagian yang sama dapat digunakan kembali.
- Mempermudah perawatan program, karena perubahan cukup dilakukan pada modul terkait.
- Membuat kode lebih rapi, sehingga mudah dibaca dan dipahami.
- Mempermudah kerja tim, karena setiap anggota dapat mengerjakan modul yang berbeda.

2.	Apa perbedaan include dan require ketika file yang dipanggil tidak ditemukan?
- include akan menghasilkan pesan warning, tetapi program tetap melanjutkan proses ke baris berikutnya.
- require akan menghasilkan fatal error sehingga program berhenti dan baris berikutnya tidak dijalankan.

3.	Mengapa require_once sesuai digunakan untuk memuat konfigurasi database?
Karena konfigurasi database merupakan bagian penting yang wajib tersedia agar aplikasi dapat berjalan. require_once memastikan file konfigurasi hanya dimuat satu kali sehingga tidak terjadi pemanggilan berulang atau deklarasi ganda. Jika file tidak ditemukan, program akan berhenti sehingga kesalahan dapat diketahui.

4.	Jelaskan perbedaan parameter, argumen, dan nilai return pada function. 
- Parameter adalah variabel yang ditulis pada deklarasi function untuk menerima nilai.
- Argumen adalah nilai yang diberikan ketika function dipanggil.
- Return adalah nilai yang dikembalikan oleh function kepada bagian program yang memanggilnya.
Contoh:
```function hitungLuas($panjang, $lebar) {
    return $panjang * $lebar;
}

$hasil = hitungLuas(8, 5);
echo $hasil;
```

Keterangan:
- $panjang dan $lebar adalah parameter.
- 8 dan 5 adalah argumen.
- $panjang * $lebar adalah nilai return, yaitu 40.

5.	Mengapa header dan footer sebaiknya dipisahkan dari konten halaman?
Karena header dan footer merupakan bagian tampilan yang digunakan bersama oleh beberapa halaman. Dengan memisahkannya, tampilan website menjadi lebih konsisten, kode tidak perlu ditulis berulang kali, dan perubahan dapat dilakukan cukup pada satu file tanpa mengubah seluruh halaman.

6.	Apa fungsi index.php pada pola routing yang dipraktikkan?
index.php berfungsi sebagai router atau titik masuk utama aplikasi. File ini bertugas membaca parameter page dari URL, memeriksa apakah halaman tersedia dalam daftar rute, memeriksa hak akses pengguna, kemudian memanggil file halaman yang sesuai. Jika halaman tidak ditemukan, router akan menampilkan halaman 404.

7.	Mengapa router sebaiknya menggunakan whitelist rute?
Karena whitelist membatasi halaman yang boleh diakses hanya pada rute yang sudah didaftarkan oleh pengembang. Hal ini meningkatkan keamanan aplikasi, mencegah akses ke file yang tidak seharusnya dibuka, dan memastikan halaman yang tidak terdaftar akan menghasilkan error 404.

8.	Apa risiko jika input page langsung digabungkan menjadi path file yang di-require?
Risikonya adalah Path Traversal dan Local File Inclusion (LFI). Penyerang dapat memanipulasi parameter page untuk mencoba mengakses file di luar direktori aplikasi, seperti file konfigurasi atau file sistem. Jika file berbahaya berhasil dimuat, penyerang dapat menyebabkan kebocoran informasi atau menjalankan kode yang tidak diinginkan.


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
<img width="372" height="181" alt="Screenshot 2026-11-26 141139" src="https://github.com/user-attachments/assets/2bf072cd-2ab4-4378-9022-b164f2f54591" />

### 1. Pengujian `include` dan `require`

File `uji-include.php` dan `uji-require.php` memanggil `pesan.php`.

- `include`: jika file tidak ditemukan, PHP memberikan warning dan proses program tetap berlanjut.
- `require`: jika file tidak ditemukan, PHP menghasilkan fatal error dan proses program berhenti.

<img width="523" height="185" alt="Screenshot 2026-11-26 144648" src="https://github.com/user-attachments/assets/d9bfc796-2d78-41ff-9a44-16fff160d2ca" />

### 2. Template Multi-Halaman

Halaman Home, Profil, dan Kontak menggunakan `header.php` dan `footer.php` yang sama. Pemisahan ini mengurangi pengulangan kode dan membuat tampilan antarhalaman konsisten.

<img width="653" height="329" alt="Screenshot 2026-11-26 141152" src="https://github.com/user-attachments/assets/56655e5c-b244-4930-ae14-ed78fd891761" />

<img width="650" height="332" alt="Screenshot 2026-11-26 141215" src="https://github.com/user-attachments/assets/ed1b4fcd-d191-4ffe-b44b-10deb402f620" />

<img width="662" height="332" alt="Screenshot 2026-11-26 141233" src="https://github.com/user-attachments/assets/f60cdfc6-b087-4ec2-a55c-4eae72bb5277" />
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
<img width="650" height="336" alt="Screenshot 2026-11-26 141308" src="https://github.com/user-attachments/assets/5e3114cc-e889-4008-b6ab-d478894a947f" />
<img width="641" height="415" alt="Screenshot 2026-11-26 141320" src="https://github.com/user-attachments/assets/eacd6166-89bc-46d9-93ad-d02b59a58b2c" />
<img width="635" height="421" alt="Screenshot 2026-11-26 141337" src="https://github.com/user-attachments/assets/2d470928-8413-43b5-ad9a-53a793685d65" />

### 4. Router dengan Whitelist

`index.php` membaca parameter `page` dari URL dan mencocokkannya dengan daftar rute yang diizinkan. Jika rute tidak terdaftar atau input bukan string, aplikasi menampilkan halaman 404. Input URL tidak digunakan langsung sebagai path file.
<img width="645" height="356" alt="Screenshot 2026-11-26 141400" src="https://github.com/user-attachments/assets/78d97b20-cf81-4815-9a56-9d6ce4a7c87b" />
<img width="647" height="328" alt="Screenshot 2026-11-26 141407" src="https://github.com/user-attachments/assets/27497871-d153-4cd3-8e2e-f0fe5edcfa86" />
<img width="647" height="368" alt="Screenshot 2026-11-26 141419" src="https://github.com/user-attachments/assets/752ff72d-3954-4e02-9228-a36ff2cc73b3" />
<img width="634" height="323" alt="Screenshot 2026-11-26 141432" src="https://github.com/user-attachments/assets/75546125-bf3c-4130-925c-2fe938b90dbf" />
<img width="652" height="334" alt="Screenshot 2026-11-26 141439" src="https://github.com/user-attachments/assets/352b5bd3-0416-4150-b872-c75578c22717" />

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
