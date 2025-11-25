<?php

// Kontrak ini mendefinisikan semua operasi CRUD yang harus diimplementasikan oleh Model data Mobil
interface KontrakModelMobil
{
    // Method READ (Ambil Data)
    public function getAllMobil(): array; // Mengambil semua data mobil dari database
    public function getMobilById($id): ?array; // Mengambil satu data mobil berdasarkan ID

    // Method CRUD
    // Menambahkan data mobil baru ke database
    public function addMobil($kodeRangka, $merkMesin, $warna, $topKecepatan): void;
    // Memperbarui data mobil yang sudah ada berdasarkan ID
    public function updateMobil($id, $kodeRangka, $merkMesin, $warna, $topKecepatan): void;
    // Menghapus data mobil berdasarkan ID
    public function deleteMobil($id): void;
}

?>