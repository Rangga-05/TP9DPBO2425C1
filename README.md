# 🏎️ TP9DPBO2425C1
TP 9 DPBO Model-View-Presenter (MVP) Membuat Dashboard Data Pembalap Dan Mobil

# Janji
Saya Muhammad Rangga Nur Praditha dengan Nim 2400297 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan. Aamiin

# Program CRUD Balap (Pembalap & Mobil)
Aplikasi ini dibuat sebagai tugas perkuliahan untuk mendemonstrasikan pemahaman dan implementasi arsitektur Model–View–Presenter (MVP) pada PHP Native.<br>
Tujuan utamanya adalah:
1. Mengimplementasikan fitur CRUD (Create, Read, Update, Delete) secara lengkap pada dua entitas data yang saling terkait (Pembalap dan Mobil).
2. Menerapkan prinsip OOP dan Abstraksi dengan penggunaan Kontrak/Interface di setiap lapisan (Model, View, Presenter).
3. Memastikan lapisan View tidak memiliki akses langsung ke Model (database).

## 1. **Arsitektur Program (MVP)**
Aplikasi ini dirancang menggunakan arsitektur Model–View–Presenter (MVP) untuk memastikan pemisahan tanggung jawab logika program.<br>
Komponen dan Tanggung Jawab:
1. **Model** (di folder `models/`): Bertanggung jawab atas data, koneksi database (DAO), dan entitas data. Model di sini mengimplementasikan KontrakModel dan mencakup class DAO seperti `TabelMobil.php`.
2. **View** (di folder `views/`): Bertanggung jawab penuh untuk merakit data yang diterima menjadi tampilan HTML. View mengimplementasikan KontrakView, contohnya `ViewMobil.php`.
3. **Presenter** (di folder `presenters/`): Bertindak sebagai pengontrol logika aplikasi (Flow Control & CRUD). Presenter menghubungkan Model dan View, contohnya `PresenterMobil.php`.
4. **Router** (file `index.php`): Berfungsi sebagai pintu masuk tunggal aplikasi, menganalisis URL (`nav=...`), dan memuat Presenter yang benar.<br>
Prinsip Utama:
- **Kontrak (Interface):** Setiap lapisan (Model, View, Presenter) memiliki Interface wajib (`Kontrak...`) untuk memastikan Abstraksi, di mana komponen hanya mengetahui fungsi yang ditawarkan tanpa tahu detail implementasinya.
- **Database:** Menggunakan class `DB.php` sebagai base class untuk koneksi PDO yang aman (mencegah SQL Injection melalui Prepared Statements).

## 2. Alur Program (Flow)
Alur kerja ditentukan oleh Presenter. Berikut adalah contoh alur operasi CRUD:<br>
**A. Alur Tampilan List (Read)**<br>
1. Permintaan diterima oleh `index.php`.
2. Router memuat `PresenterMobil` dan memanggil `proses()`.
3. `PresenterMobil` memanggil `tampilkanMobil()` dan memerintahkan `TabelMobil` (Model DAO) untuk mengambil semua data.
4. `TabelMobil` mengembalikan data mentah (array).
5. `PresenterMobil` mengubah data menjadi Array of Objects (`Mobil.php`).
6. Array of Objects diberikan kepada `ViewMobil.tampilMobil()`.
7. `ViewMobil` menyuntikkan data ke Template (`listMobil.html`) dan mengembalikan HTML.
8. HTML ditampilkan ke browser.

**B. Alur Simpan/Hapus Data (Create & Delete)**<br>
1. User melakukan aksi (misalnya, klik tombol Hapus). Data dikirim melalui `POST` ke `index.php`.
2. Router mendeteksi permintaan `POST` dan memanggil method CRUD di `PresenterMobil` (misalnya `hapusMobil($id)`).
3. `PresenterMobil` memerintahkan `TabelMobil` (Model DAO) untuk menjalankan query `DELETE FROM mobil WHERE id = $id`.
4. Setelah sukses, Router menjalankan Post-Redirect-Get (PRG) melalui `header("Location: index.php?nav=mobil")` untuk mencegah form resubmission.

## 3. Desain Program (UI/UX)
Aplikasi menggunakan tema F1 Maroon yang seragam di seluruh fitur (Pembalap dan Mobil).
- **Tema Warna:** Merah Maroon (`#800000`) menjadi warna utama (tombol, header, aksen).
- **Layout:** Menggunakan Card Layout di atas background putih bersih, memberikan tampilan modern.
- **Navigasi:** Terdapat Tab Navigasi yang jelas antara **PEMBALAP** dan **MOBIL**.
- **Header Tabel:** Berwarna Maroon solid dengan teks Putih (gaya F1).
- **Tabel Data:** Menerapkan Zebra Striping (baris selang-seling Putih dan Merah Muda Halus) untuk keterbacaan yang tinggi.
- **Form Input:** Label input berwarna Maroon, dan input field memiliki glow berwarna Maroon saat diklik.

## 4. Struktur Folder Program
Struktur folder program ini terorganisir untuk memisahkan setiap lapisan arsitektur MVP:
- **`models/`:** Berisi semua yang terkait data, seperti `DB.php` (koneksi), `KontrakModel.php` (interface), dan Class DAO (`TabelPembalap.php`, `TabelMobil.php`) serta Class Entity (`Pembalap.php`, `Mobil.php`).
- **`presenters/`:** Berisi Kontrak dan Class Presenter (`PresenterPembalap.php`, `PresenterMobil.php`) yang mengatur alur logika.
- **`views/`:** Berisi Kontrak dan Class View (`ViewPembalap.php`, `ViewMobil.php`) yang bertugas merender output.
- **`template/`:** Berisi file HTML murni (`.html`) yang berfungsi sebagai skin atau cetakan untuk View.
- **`index.php`:** Berada di root dan berfungsi sebagai Router utama aplikasi.

# Dokumentasi
https://github.com/user-attachments/assets/7778076d-d030-4886-a812-6830a6dd8149
