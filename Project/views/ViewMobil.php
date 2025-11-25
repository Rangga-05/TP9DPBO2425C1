<?php

include_once("models/Mobil.php");
include_once("KontrakViewMobil.php");

// Class ini mengimplementasikan KontrakViewMobil
class ViewMobil implements KontrakViewMobil
{
    // Implementasi Method Kontrak (Tampilan List)
    // Menerima list Mobil (Array of Objects) dan merender tampilan tabel
    public function tampilMobil($listMobil)
    {
        // Membangun baris tabel (tbody) dari data objek
        $tbody = '';
        $no = 1;
        foreach ($listMobil as $mobil) {
            $tbody .= '<tr>';
            $tbody .= '<td>' . $no++ . '</td>';
            $tbody .= '<td style="font-weight:600">' . htmlspecialchars($mobil->getKodeRangka()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($mobil->getMerkMesin()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($mobil->getWarna()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($mobil->getTopKecepatan()) . ' km/h</td>';
            // Tombol Aksi (Edit dan Hapus)
            $tbody .= '<td>
                        <div class="action-group">
                            <a href="index.php?nav=mobil&screen=edit&id=' . $mobil->getId() . '" class="btn btn-sm btn-edit">Edit</a>
                            <button data-id="' . $mobil->getId() . '" class="btn btn-sm btn-delete">Hapus</button>
                        </div>
                      </td>';
            $tbody .= '</tr>';
        }

        // Mengambil konten template (listMobil.html)
        $templatePath = __DIR__ . '/../template/listMobil.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // Menyuntikkan data ke template (mengganti placeholder)
            $template = str_replace('DATA_TABEL', $tbody, $template);
            $template = str_replace('DATA_TOTAL', count($listMobil), $template);
            
            return $template;
        } else {
            return "Error: Template listMobil.html tidak ditemukan!";
        }
    }

    // Implementasi Method Kontrak (Tampilan Form)
    // Menerima data Mobil (untuk mode Edit) dan merender tampilan Form
    public function tampilFormMobil($data = null)
    {
        // Mengambil konten template form
        $template = file_get_contents(__DIR__ . '/../template/formMobil.html');
        
        // Logika untuk mode EDIT (pre-fill data)
        if ($data) {
            // Mengubah aksi tersembunyi dari 'add' menjadi 'edit'
            $template = str_replace('value="add" id="mobil-action"', 'value="edit" id="mobil-action"', $template);
            // Menyuntikkan ID dan nilai-nilai data lama ke dalam input form
            $template = str_replace('value="" id="mobil-id"', 'value="' . $data['id'] . '"', $template);
            $template = str_replace('id="kodeRangka" type="text" placeholder="Cth: RB19"', 'id="kodeRangka" type="text" value="' . $data['kodeRangka'] . '"', $template);
            $template = str_replace('id="merkMesin" type="text" placeholder="Cth: Honda RBPT"', 'id="merkMesin" type="text" value="' . $data['merkMesin'] . '"', $template);
            $template = str_replace('id="warna" type="text" placeholder="Cth: Navy Blue"', 'id="warna" type="text" value="' . $data['warna'] . '"', $template);
            $template = str_replace('id="topKecepatan" type="number" placeholder="0"', 'id="topKecepatan" type="number" value="' . $data['topKecepatan'] . '"', $template);
        }
        return $template;
    }
}
?>