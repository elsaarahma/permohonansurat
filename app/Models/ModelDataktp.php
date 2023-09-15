<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDataktp extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengantar_ktp';
    protected $primaryKey       = 'id_ktp';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','nik','nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin',
                                    'alamat','agama','status_perkawinan','pekerjaan','kewarganegaraan',
                                    'berlaku','gol_darah','tgl_pembuatan'];

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
        $query = $this->db->query("SELECT * FROM pengantar_ktp ORDER BY id_ktp DESC");
        return $query->getResultArray(); // Menggunakan getResultArray() untuk mendapatkan array
    } 
}
