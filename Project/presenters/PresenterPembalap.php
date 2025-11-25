<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/ViewPembalap.php");

// Class ini bertindak sebagai Presenter yang mengimplementasikan KontrakPresenter
class PresenterPembalap implements KontrakPresenter
{
    // Properti: Instansi Model (TabelPembalap) dan View (ViewPembalap)
    private $tabelPembalap;
    private $viewPembalap;

    // Data list pembalap, disimpan dalam bentuk Array of Objects
    private $listPembalap = [];

    // Konstruktor: Menerima Model dan View, lalu menjalankan inisialisasi data
    public function __construct($tabelPembalap, $viewPembalap)
    {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        $this->initListPembalap();
    }

    // Method untuk initialisasi list pembalap dari database
    // Mengambil data dari TabelPembalap dan mengubahnya menjadi array objek Pembalap
    public function initListPembalap()
    {
        // Dapatkan data mentah
        $data = $this->tabelPembalap->getAllPembalap();

        // Buat objek Pembalap dan simpan di listPembalap
        $this->listPembalap = [];
        foreach ($data as $item) {
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang']
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    // Method untuk menampilkan daftar pembalap menggunakan View
    public function tampilkanPembalap(): string
    {
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    // Method untuk menampilkan form
    public function tampilkanFormPembalap($id = null): string
    {
        $data = null;
        if ($id !== null) {
            $data = $this->tabelPembalap->getPembalapById($id);
        }
        return $this->viewPembalap->tampilFormPembalap($data);
    }

    // Implementasi Method Kontrak (CRUD)
    // implementasikan metode
    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $this->tabelPembalap->addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }
    
    // Menerima data baru dan ID, lalu memanggil method updatePembalap
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }
    
    // Menerima ID dan memanggil method deletePembalap
    public function hapusPembalap($id): void {
        $this->tabelPembalap->deletePembalap($id);
    }
}

?>