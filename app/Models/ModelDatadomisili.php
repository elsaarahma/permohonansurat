<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDatadomisili extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pindah_domisili';
    protected $primaryKey       = 'id_domisili';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','nama_pemohon','nik','alamat_lama','alamat_baru','tanggal_pindah','alasan_pindah',
                                 'jml_anggota','tgl_pembuatan',];

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
        $query = $this->db->query("SELECT * FROM pindah_domisili ORDER BY id_domisili DESC");
        return $query->getResultArray(); // Menggunakan getResultArray() untuk mendapatkan array
    } 
    
}
