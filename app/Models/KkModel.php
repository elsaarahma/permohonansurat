<?php

namespace App\Models;

use CodeIgniter\Model;

class KkModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengantar_kk';
    protected $primaryKey       = 'id_kk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori_surat','no_registrasi','nama_kk','nik_kk','alamat','desa_kelurahan','kecamatan','kabupaten_kota',
                                    'provinsi','kode_pos','jml_anggota','tujuan','tgl_pembuatan'];

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
    public function editData($id_kk, $data)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $id_kk)->update($data);
    }
    function deleteData($id_kk)
    {
    return $this->delete($id_kk);
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
