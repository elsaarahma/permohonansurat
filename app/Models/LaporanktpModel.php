<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanktpModel extends Model
{

    protected $table = 'pengantar_ktp';

    function getdataktp() 
    {
        return $this->findAll(); 
    }

    public function getdataktpByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tgl_pembuatan >=', $tanggal_awal)
                    ->where('tgl_pembuatan <=', $tanggal_akhir)
                    ->findAll();
    }
}
?>
