<?php

include_once(__DIR__ . "/../models/TabelMobil.php");
include_once(__DIR__ . "/../models/Mobil.php");
include_once(__DIR__ . "/../views/ViewMobil.php");
include_once(__DIR__ . "/KontrakPresenterMobil.php");

// Class ini bertindak sebagai Presenter yang mengimplementasikan KontrakPresenterMobil
class PresenterMobil implements KontrakPresenterMobil
{
    // Properti: Instansi Model DAO dan View
    private $tabelMobil;
    private $viewMobil;

    // Konstruktor: Menerima instance Model dan View yang sudah terinisialisasi
    public function __construct($tabelMobil, $viewMobil)
    {
        $this->tabelMobil = $tabelMobil;
        $this->viewMobil = $viewMobil;
    }

    // Implementasi Method Kontrak (Tampilan)
    // Mengambil dan memproses data Mobil dari Model DAO untuk ditampilkan
    public function tampilkanMobil(): string
    {
        // Ambil data mentah
        $rawData = $this->tabelMobil->getAllMobil();

        // Mengubah array asosiatif menjadi Array of Objects (Entity Mobil)
        $listMobil = [];
        foreach ($rawData as $row) {
            $listMobil[] = new Mobil(
                $row['id'], 
                $row['kodeRangka'], 
                $row['merkMesin'], 
                $row['warna'], 
                $row['topKecepatan']
            );
        }
    
        // Mengirim data objek ke View untuk di-render menjadi HTML
        return $this->viewMobil->tampilMobil($listMobil);
    }

    // Mempersiapkan data untuk Form. Jika mode Edit, ambil data lama untuk pre-fill
    public function tampilkanFormMobil($id = null): string
    {
        $data = null;
        if ($id !== null) {
            // Jika ada ID, ambil data spesifik dari Model DAO
            $data = $this->tabelMobil->getMobilById($id);
        }
        // Kirim data (atau null) ke View untuk merakit form
        return $this->viewMobil->tampilFormMobil($data);
    }

    // Implementasi Method Kontrak (CRUD)
    // Menerima data baru dari Form dan memerintahkan Model DAO untuk CREATE
    public function tambahMobil($kodeRangka, $merkMesin, $warna, $topKecepatan): void
    {
        $this->tabelMobil->addMobil($kodeRangka, $merkMesin, $warna, $topKecepatan);
    }

    // Menerima ID dan data baru, lalu memerintahkan Model DAO untuk UPDATE
    public function ubahMobil($id, $kodeRangka, $merkMesin, $warna, $topKecepatan): void
    {
        $this->tabelMobil->updateMobil($id, $kodeRangka, $merkMesin, $warna, $topKecepatan);
    }

    // Menerima ID, lalu memerintahkan Model DAO untuk DELETE
    public function hapusMobil($id): void
    {
        $this->tabelMobil->deleteMobil($id);
    }

    // Method Proses (Router Internal)
    // Method utama yang dipanggil oleh index.php untuk menentukan alur kerja
    // Bertanggung jawab untuk mendeteksi apakah ada request POST (CRUD) atau GET (Tampilan)
    public function proses()
    {
        // Cek apakah ada data yang dikirim melalui POST (Aksi CRUD)
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            
            // Logika delegasi aksi CRUD
            if ($action == 'add') {
                $this->tambahMobil($_POST['kodeRangka'], $_POST['merkMesin'], $_POST['warna'], $_POST['topKecepatan']);
            } elseif ($action == 'edit') {
                $this->ubahMobil($_POST['id'], $_POST['kodeRangka'], $_POST['merkMesin'], $_POST['warna'], $_POST['topKecepatan']);
            } elseif ($action == 'delete') {
                $this->hapusMobil($_POST['id']);
            }
            
            header("Location: index.php?nav=mobil");
            exit;
        }

        // Cek apakah ada request GET untuk menampilkan layar tertentu (Tampilan)
        $screen = $_GET['screen'] ?? 'list';
        
        if ($screen == 'add') {
            // Tampilkan Form Tambah
            return $this->tampilkanFormMobil(null);
        } elseif ($screen == 'edit' && isset($_GET['id'])) {
            // Tampilkan Form Edit dengan pre-fill data berdasarkan ID
            return $this->tampilkanFormMobil($_GET['id']);
        } else {
            // Tampilkan List data Mobil (Default)
            return $this->tampilkanMobil();
        }
    }
}
?>