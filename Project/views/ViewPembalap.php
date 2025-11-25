<?php

include_once ("KontrakView.php");
include_once ("models/Pembalap.php");

// Class ini mengimplementasikan KontrakView
class ViewPembalap implements KontrakView{

    public function __construct(){
        // Konstruktor kosong
    }

    // Implementasi Method Kontrak (Tampilan List)
    // Method untuk menampilkan daftar pembalap
    public function tampilPembalap($listPembalap): string {
        // Membangun baris tabel (tbody)
        $tbody = '';
        $no = 1;
        foreach($listPembalap as $pembalap){
            $tbody .= '<tr>';
            $tbody .= '<td>'. $no++ .'</td>';
            $tbody .= '<td style="font-weight:600">'. htmlspecialchars($pembalap->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getTim()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getNegara()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getPoinMusim()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($pembalap->getJumlahMenang()) .'</td>';
            // Tombol Aksi (Edit dan Hapus)
            $tbody .= '<td>
                        <div class="action-group">
                            <a href="index.php?screen=edit&id='. $pembalap->getId() .'" class="btn btn-sm btn-edit">Edit</a>
                            <button data-id="'. $pembalap->getId() .'" class="btn btn-sm btn-delete">Hapus</button>
                        </div>
                      </td>';
            $tbody .= '</tr>';
        }

        // Mengambil konten template (skin.html)
        $templatePath = __DIR__ . '/../template/skin.html';
        $template = '';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // Menyuntikkan data ke template
            // Inject baris tabel
            $template = str_replace('DATA_TABEL', $tbody, $template);
            
             // Inject total jumlah data
            $total = count($listPembalap);
            $template = str_replace('DATA_TOTAL', $total, $template);
            
            return $template;
        }

        return "Error: Template tidak ditemukan";
    }

    // Implementasi Method Kontrak (Tampilan Form)
    // Method untuk menampilkan form tambah/ubah pembalap
    public function tampilFormPembalap($data = null): string {
        // Mengambil konten template form
        $template = file_get_contents(__DIR__ . '/../template/form.html');
        
        // Logika untuk mode EDIT (pre-fill data)
        if ($data) {
            // Mengubah aksi tersembunyi dari 'add' menjadi 'edit'
            $template = str_replace('value="add" id="pembalap-action"', 'value="edit" id="pembalap-action"', $template);
            // Menyuntikkan ID dan nilai-nilai data lama ke dalam input form
            $template = str_replace('value="" id="pembalap-id"', 'value="' . htmlspecialchars($data['id']) . '" id="pembalap-id"', $template);
            $template = str_replace('id="nama" name="nama" type="text" placeholder="Nama pembalap"', 'id="nama" name="nama" type="text" placeholder="Nama pembalap" value="' . htmlspecialchars($data['nama']) . '"', $template);
            $template = str_replace('id="tim" name="tim" type="text" placeholder="Nama tim"', 'id="tim" name="tim" type="text" placeholder="Nama tim" value="' . htmlspecialchars($data['tim']) . '"', $template);
            $template = str_replace('id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)"', 'id="negara" name="negara" type="text" placeholder="Negara (mis. Indonesia)" value="' . htmlspecialchars($data['negara']) . '"', $template);
            $template = str_replace('id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0"', 'id="poinMusim" name="poinMusim" type="number" min="0" step="1" placeholder="0" value="' . htmlspecialchars($data['poinMusim']) . '"', $template);
            $template = str_replace('id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0"', 'id="jumlahMenang" name="jumlahMenang" type="number" min="0" step="1" placeholder="0" value="' . htmlspecialchars($data['jumlahMenang']) . '"', $template);
        }
        return $template;
    }
}

?>