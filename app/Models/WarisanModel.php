<?php

namespace App\Models;

use CodeIgniter\Model;

class WarisanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ahli_waris';
    protected $primaryKey       = 'id_waris';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','id_kategori_surat','nama_lengkap','hubungan_keluarga','tempat_lahir','tanggal_lahir','alamat',
                                    'kewarganegaraan','no_ktp','nama_almarhum','tgl_pembuatan'];

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

    public function kategori()
    {
        return $this->belongsTo('App\Models\ModelKategori', 'id_kategori_surat', 'kategori_surat');
    }
    public function editData($id_waris, $data)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id_waris)->update($data);
    }

    function deleteData($id_waris)
    {
    return $this->delete($id_waris);
    }
    public function getJumlahStatusByKategori($kategoriId, $status)
    {
        return $this->where('id_kategori_surat', $kategoriId)
            ->where('status', $status)
            ->countAllResults();
    }
    public function getPendingData()
    {
        return $this->where('status', 'pending')->findAll();
    }
    public function getApprovedData()
    {
        return $this->where('status', 'disetujui')->findAll();
    }
    public function getDibatalkanData()
    {
        return $this->where('status', 'dibatalkan')->findAll();
    }
}
