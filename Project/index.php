<?php
// File ini berfungsi sebagai Single Entry Point (Router/Pintu Masuk Utama) aplikasi
// Tugasnya mengimpor semua Class yang diperlukan (Model, View, Presenter), menentukan konfigurasi database, menganalisis URL (via $_GET dan $_POST) untuk menentukan logika mana yang harus dijalankan

include_once("models/DB.php"); // Impor Class dasar koneksi database

// Impor Class untuk Fitur Pembalap
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

// Impor Class untuk Fitur Mobil
include_once("models/TabelMobil.php");
include_once("views/ViewMobil.php");
include_once("presenters/PresenterMobil.php");

// Konfigurasi Database
// Konfigurasi ini akan diteruskan ke konstruktor Class DB melalui operator spread (...)
$dbConfig = ['localhost', 'mvp_db', 'root', ''];

// Routing Utama (Menentukan Fitur: Pembalap atau Mobil)
// Cek parameter 'nav' di URL. Defaultnya adalah 'pembalap'
$nav = $_GET['nav'] ?? 'pembalap';

if ($nav == 'mobil') {
    // ALUR FITUR MOBIL
    // Inisialisasi Model, View, dan Presenter khusus Mobil
    $tabelMobil = new TabelMobil(...$dbConfig);
    $viewMobil = new ViewMobil();
    $presenter = new PresenterMobil($tabelMobil, $viewMobil);
    
    // Memanggil method 'proses()' pada PresenterMobil
    // Method ini menangani semua logika (POST/GET, CRUD, Tampilan) untuk fitur Mobil
    echo $presenter->proses();

} else {
    // ALUR FITUR PEMBALAP (Default)
    // Inisialisasi Model, View, dan Presenter khusus Pembalap
    $tabelPembalap = new TabelPembalap(...$dbConfig);
    $viewPembalap = new ViewPembalap();
    $presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);

    // Menangani Aksi POST (CRUD)
    if (isset($_POST['action'])) {
        // Cek aksi yang diminta (add, edit, atau delete)
        if ($_POST['action'] == 'add') {
            // Memanggil method 'tambahPembalap' di Presenter untuk CREATE
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            // Memanggil method 'ubahPembalap' di Presenter untuk UPDATE
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'delete') {
            // Memanggil method 'hapusPembalap' di Presenter untuk DELETE
            $presenter->hapusPembalap($_POST['id']);
        }
        // Mengalihkan kembali ke halaman list setelah aksi CRUD
        header("Location: index.php");
        exit;
    }

    // Menangani Tampilan GET (List atau Form)
    if (isset($_GET['screen'])) {
        // Jika ada parameter 'screen', tampilkan form
        if ($_GET['screen'] == 'add') echo $presenter->tampilkanFormPembalap(); // Tampilkan form tambah
        elseif ($_GET['screen'] == 'edit') echo $presenter->tampilkanFormPembalap($_GET['id']); // Tampilkan form tambah
    } else {
        // Default: Tampilkan List Pembalap
        $html = $presenter->tampilkanPembalap();
        // Inject navigasi sederhana (Meski sudah di handle di template, ini adalah safety net/kode lama)
        echo str_replace('<h1>Daftar Pembalap</h1>', '<h1>Daftar Pembalap</h1><div style="margin-bottom:15px;font-size:14px;"><b>Pembalap</b> | <a href="index.php?nav=mobil">Mobil</a></div>', $html);
    }
}
?>