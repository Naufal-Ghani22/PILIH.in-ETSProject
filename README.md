# PILIH.in - Aplikasi Tes Minat Jurusan

Aplikasi web untuk membantu siswa memilih jurusan kuliah berdasarkan tes minat bakat dengan algoritma presisi.

## Fitur Utama

- **Autentikasi**: Login dan registrasi pengguna
- **Tes Minat**: 8 pertanyaan untuk menentukan kecocokan jurusan
- **Hasil Tes**: Visualisasi skor dengan radar chart dan rekomendasi jurusan
- **Roadmap Pembelajaran**: Timeline semester 1-8 untuk jurusan pilihan
- **Eksplorasi Kampus**: Daftar kampus dengan filter akreditasi dan biaya
- **Dashboard**: Riwayat tes dan akses cepat ke fitur

## Teknologi

- **Backend**: PHP 8.4
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, Tailwind CSS 4.2
- **JavaScript**: Vanilla JS untuk interaktivitas
- **Charts**: Chart.js untuk visualisasi data

## Struktur Proyek

```
PILIH.in-ETS/
├── index.php          # Halaman landing
├── auth.php           # Halaman login/register
├── dashboard.php      # Dashboard pengguna
├── tes.php            # Form tes minat
├── hasil.php          # Hasil tes dengan chart
├── roadmap.php        # Timeline pembelajaran
├── kampus.php         # Eksplorasi kampus
├── logout.php         # Logout handler
├── proses_auth.php    # Proses autentikasi
├── proses_tes.php     # Proses tes dan kalkulasi skor
├── components/
│   ├── navbar.php     # Navigation bar
│   └── footer.php     # Footer
├── database/
│   ├── koneksi.php    # Koneksi database
│   └── pilihin.sql    # Schema database
├── src/
│   ├── input.css      # Tailwind input
│   └── output.css     # Tailwind compiled CSS
└── package.json       # Dependencies
```

## Setup

1. **Database**:
   - Import `database/pilihin.sql` ke MySQL
   - Konfigurasi koneksi di `database/koneksi.php`

2. **Web Server**:
   - Gunakan XAMPP atau server PHP lainnya
   - Pastikan folder proyek di `htdocs`

3. **CSS**:
   - Tailwind sudah dikompilasi di `src/output.css`
   - Untuk development: `npx tailwindcss -i src/input.css -o src/output.css --watch`

4. **Jalankan**:
   - Akses `http://localhost/PILIH.in-ETS/`

## Flow Aplikasi

1. User mengakses index.php
2. Jika belum login → auth.php untuk register/login
3. Setelah login → dashboard.php
4. Ambil tes di tes.php
5. Lihat hasil di hasil.php
6. Eksplor roadmap di roadmap.php
7. Cari kampus di kampus.php

## Dummy Data

Saat ini menggunakan data dummy untuk testing UI. Untuk production, ganti dengan query database.

## Catatan

- Session management sudah diimplementasi
- Validasi form client-side dan server-side
- Responsive design dengan Tailwind CSS
- PRG pattern untuk form submission

## Lisensi

© 2026 PILIH.in - Semua hak dilindungi.
