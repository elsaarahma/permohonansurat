<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDatapindah extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pindah_keluar';
    protected $primaryKey       = 'id_pindah_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','nama_pemohon','no_kk','no_nik','tempat_lahir','tanggal_lahir','alamat_asal','alamat_tujuan',
                                 'jml_anggota','tujuan','tanggal_dibuat','tempat_dibuat'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getdata()
    {
        $query = $this->db->query("SELECT * FROM pindah_keluar ORDER BY id_pindah_keluar DESC");
        return $query->getResultArray(); // Menggunakan getResultArray() untuk mendapatkan array
    } 
    
}
