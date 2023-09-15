<?php

namespace App\Models;

use CodeIgniter\Model;

class TanahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'keterangan_tanah';
    protected $primaryKey       = 'id_tanah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','identitas_pemilik','luas_tanah','bentuk_hak','status_tanah',
                                    'batas_tanah','penggunaan_tanah','riwayat_transaksi','tgl_pembuatan'];

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
    public function editData($id_tanah, $data)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id_tanah)->update($data);
    }

    function deleteData($id_tanah)
    {
    return $this->delete($id_tanah);
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
