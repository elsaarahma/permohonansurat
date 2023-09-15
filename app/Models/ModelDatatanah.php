<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDatatanah extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'keterangan_tanah';
    protected $primaryKey       = 'id_tanah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','identitas_tanah','luas_tanah','bentuk_hak','status_tanah','batas_tanah',
                                    'penggunaan_tanah','riwayat_transaksi','tgl_pembuatan'];

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
        $query = $this->db->query("SELECT * FROM keterangan_tanah ORDER BY id_tanah DESC");
        return $query->getResultArray(); // Menggunakan getResultArray() untuk mendapatkan array
    } 
    
}
