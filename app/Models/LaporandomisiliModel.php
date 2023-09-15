<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporandomisiliModel extends Model
{
    protected $table = 'pindah_domisili';

    function getdatadomisili() 
    {
        return $this->findAll(); 
    }

    public function getdatadomisiliByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tgl_pembuatan >=', $tanggal_awal)
                    ->where('tgl_pembuatan <=', $tanggal_akhir)
                    ->findAll();
    }
}
?>
