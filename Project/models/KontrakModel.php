<?php

/*

    Interface ini mendefinisikan struktur dasar yang harus dimiliki oleh setiap Model 
    dalam arsitektur MVP (Model–View–Presenter).

    Interface ini berfungsi sebagai kontrak antara Presenter dan Model, 
    yang menentukan metode-metode CRUD (Create, Read, Update, Delete) 
    yang wajib diimplementasikan oleh Model.

    Dengan adanya kontrak ini, setiap anggota tim dapat 
    bekerja dengan pola yang sama, menjaga konsistensi struktur kode,  
    dan memungkinkan dikerjakan secara paralel 
    tanpa saling mengganggu bagian kode lainnya.

*/

interface KontrakModel
{
    // Method READ (Ambil Data)
    public function getAllPembalap(): array; //Mengambil semua data pembalap dari database
    public function getPembalapById($id): ?array; // Mengambil satu data pembalap berdasarkan ID

    
    // method crud pembalap
    // Menambahkan data pembalap baru ke database
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    // Memperbarui data pembalap yang sudah ada
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    // Menghapus data pembalap berdasarkan ID
    public function deletePembalap($id): void;
}

?>
