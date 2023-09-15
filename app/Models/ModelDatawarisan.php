<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDatawarisan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ahli_waris';
    protected $primaryKey       = 'id_waris';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','nama_lengkap','hubungan_keluarga','tempat_lahir','tanggal_lahir','alamat','kewarganegaraan','no_ktp',
                                    'nama_almarhum','tgl_pembuatan'];

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
        $query = $this->db->query("SELECT * FROM ahli_waris ORDER BY id_waris DESC");
        return $query->getResultArray(); // Menggunakan getResultArray() untuk mendapatkan array
    } 
    
}
