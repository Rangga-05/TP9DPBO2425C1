<?php

// Kontrak ini mendefinisikan metode-metode yang harus diimplementasikan oleh ViewPembalap
interface KontrakView
{
    // Method Tampilan List
    // Menerima list data Pembalap (Array of Objects) dari Presenter
    public function tampilPembalap($listPembalap): string;
    // Method Tampilan Form
    // Menerima data Pembalap (jika ada) dan merender tampilan Form
    public function tampilFormPembalap($data = null): string;
}

?>