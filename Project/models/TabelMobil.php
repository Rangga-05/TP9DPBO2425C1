<?php

include_once("DB.php");
include_once("KontrakModelMobil.php");

// Class ini adalah Data Access Object yang fokus pada tabel 'mobil'
class TabelMobil extends DB implements KontrakModelMobil
{
    // Konstruktor untuk inisialisasi koneksi DB
    public function __construct($host, $db_name, $username, $password)
    {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method READ (Ambil Data)
    // Mengambil semua data mobil
    public function getAllMobil(): array
    {
        $query = "SELECT * FROM mobil";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // Mengambil satu data mobil berdasarkan ID
    public function getMobilById($id): ?array
    {
        $this->executeQuery("SELECT * FROM mobil WHERE id = :id", ['id' => $id]);
        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    // Method CRUD
    // Menambahkan data mobil baru (Create)
    public function addMobil($kodeRangka, $merkMesin, $warna, $topKecepatan): void
    {
        $query = "INSERT INTO mobil (kodeRangka, merkMesin, warna, topKecepatan) VALUES (:kode, :mesin, :warna, :speed)";
        $this->executeQuery($query, [
            'kode' => $kodeRangka,
            'mesin' => $merkMesin,
            'warna' => $warna,
            'speed' => $topKecepatan
        ]);
    }

    // Memperbarui data mobil (Update)
    public function updateMobil($id, $kodeRangka, $merkMesin, $warna, $topKecepatan): void
    {
        $query = "UPDATE mobil SET kodeRangka = :kode, merkMesin = :mesin, warna = :warna, topKecepatan = :speed WHERE id = :id";
        $this->executeQuery($query, [
            'id' => $id,
            'kode' => $kodeRangka,
            'mesin' => $merkMesin,
            'warna' => $warna,
            'speed' => $topKecepatan
        ]);
    }

    // Menghapus data mobil berdasarkan ID (Delete)
    public function deleteMobil($id): void
    {
        $query = "DELETE FROM mobil WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
    }
}

?>