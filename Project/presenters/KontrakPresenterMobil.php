<?php

// Kontrak ini mendefinisikan semua method yang harus dimiliki oleh PresenterMobil
interface KontrakPresenterMobil
{
    // Method READ (Menampilkan Data)
    // Method untuk tampilkan list
    public function tampilkanMobil(): string;

    // Method untuk tampilkan form
    public function tampilkanFormMobil($id = null): string;

    // Method untuk proses data CRUD
    // Menerima data baru dari Form dan memerintahkan Model untuk CREATE (Tambah) data
    public function tambahMobil($kodeRangka, $merkMesin, $warna, $topKecepatan): void;
    // Menerima data dari Form dan memerintahkan Model untuk UPDATE (Ubah) data
    public function ubahMobil($id, $kodeRangka, $merkMesin, $warna, $topKecepatan): void;
    // Menerima ID dan memerintahkan Model untuk DELETE (Hapus) data
    public function hapusMobil($id): void;
}

?>