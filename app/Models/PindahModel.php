<?php

namespace App\Models;

use CodeIgniter\Model;

class PindahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pindah_keluar';
    protected $primaryKey       = 'id_pindah_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','nama_pemohon','no_kk','no_nik','tempat_lahir','tanggal_lahir','alamat_asal',
                                   'alamat_tujuan','jml_anggota','tujuan','tanggal_dibuat','tempat_dibuat' ];

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
    public function editData($id_pindah_keluar, $data)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id_pindah_keluar)->update($data);
    }

    function deleteData($id_pindah_keluar)
    {
    return $this->delete($id_pindah_keluar);
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
