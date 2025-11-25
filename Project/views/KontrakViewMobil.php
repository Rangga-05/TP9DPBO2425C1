<?php

// Kontrak ini mendefinisikan metode-metode yang harus diimplementasikan oleh ViewMobil
interface KontrakViewMobil
{
    // Method Tampilan List
    // Menerima list data Mobil (Array of Objects) dari Presenter
    public function tampilMobil($listMobil);
    // Method Tampilan Form
    // Menerima data Mobil (jika ada) dan merender tampilan Form
    public function tampilFormMobil($data = null);
}

?>