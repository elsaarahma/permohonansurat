<?php 
namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
   

    protected $table = 'permohonan_surat';

    // Fungsi untuk menghitung jumlah status berdasarkan kategori surat
    public function getJumlahStatusByKategori($id_kategori_surat, $status)
    {
        return $this->where('id_kategori_surat', $id_kategori_surat)
            ->where('status', $status)
            ->countAllResults();
    }
}
?>