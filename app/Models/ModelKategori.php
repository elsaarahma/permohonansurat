<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori_surat';
    protected $primaryKey       = 'id_kategori_surat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','kategori_surat'];

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

   
    public function kk()
    {
        return $this->hasMany(KkModel::class, 'id_kategori_surat', 'kategori_surat');
    }
    public function getdata()
    {
        $query = $this->db->query("SELECT * FROM kategori_surat ORDER BY id_kategori_surat DESC");
        return $query->getResultArray(); // Menggunakan getResultArray() untuk mendapatkan array
    }

    function edit($id_kategori_surat, $kategori_surat)
    {
        $data = [
            'kategori_surat' => $kategori_surat,
        ];
        $this->db->table('kategori_surat')->where('id_kategori_surat', $id_kategori_surat)->update($data);
    }

    function deleteData($id_kategori_surat)
    {
        return $this->db->table('kategori_surat')->where('id_kategori_surat', $id_kategori_surat)->delete();
    }
    public function getKategoriOptions()
    {
        return $this->db->table('kategori_surat')->get()->getResultArray();
    }

}
