<?php

// Class merepresentasikan satu unit Mobil Balap
class Mobil
{
    // Atribut data Mobil
    private $id;
    private $kodeRangka;
    private $merkMesin;
    private $warna;
    private $topKecepatan;

    // Constructor untuk inisialisasi objek Mobil
    public function __construct($id, $kodeRangka, $merkMesin, $warna, $topKecepatan)
    {
        $this->id = $id;
        $this->kodeRangka = $kodeRangka;
        $this->merkMesin = $merkMesin;
        $this->warna = $warna;
        $this->topKecepatan = $topKecepatan;
    }

    // Method Getter
    public function getId() { return $this->id; }
    public function getKodeRangka() { return $this->kodeRangka; }
    public function getMerkMesin() { return $this->merkMesin; }
    public function getWarna() { return $this->warna; }
    public function getTopKecepatan() { return $this->topKecepatan; }
}

?>