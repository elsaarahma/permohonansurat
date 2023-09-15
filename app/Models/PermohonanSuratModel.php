<?php

namespace App\Models;

use CodeIgniter\Model;

class PermohonanSuratModel extends Model
{
    protected $table = 'permohonan_surat';
    protected $primaryKey = 'id_permohonan';
    protected $allowedFields = ['id_kategori_surat']; // Tambahkan field 'status' di sini

    public function getJumlahStatusByKategori($kategoriId, $status)
    {
        return $this->where('id_kategori_surat', $kategoriId)
            ->where('status', $status) // Gunakan nilai ENUM yang benar
            ->countAllResults();
    }
    
}
?>
