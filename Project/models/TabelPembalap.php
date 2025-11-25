<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

// Class ini bertugas sebagai Data Access Object yang berinteraksi langsung dengan tabel 'pembalap' di database
class TabelPembalap extends DB implements KontrakModel {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk dapat semua pembalap
    public function getAllPembalap(): array {
        $query = "SELECT * FROM pembalap";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // Method untuk dapat pembalap berdasarkan ID
    public function getPembalapById($id): ?array {
        $this->executeQuery("SELECT * FROM pembalap WHERE id = :id", ['id' => $id]);
        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    // Method CRUD
    // Menambahkan data pembalap baru ke tabel
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $query = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES (:nama, :tim, :negara, :poin, :menang)";
        $this->executeQuery($query, [
            'nama' => $nama,
            'tim' => $tim,
            'negara' => $negara,
            'poin' => $poinMusim,
            'menang' => $jumlahMenang
        ]);
    }
    
    // Memperbarui data pembalap yang sudah ada berdasarkan ID
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $query = "UPDATE pembalap SET nama = :nama, tim = :tim, negara = :negara, poinMusim = :poin, jumlahMenang = :menang WHERE id = :id";
        $this->executeQuery($query, [
            'id' => $id,
            'nama' => $nama,
            'tim' => $tim,
            'negara' => $negara,
            'poin' => $poinMusim,
            'menang' => $jumlahMenang
        ]);
    }
    
    // Menghapus data pembalap berdasarkan ID
    public function deletePembalap($id): void {
        $query = "DELETE FROM pembalap WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
    }

}

?>