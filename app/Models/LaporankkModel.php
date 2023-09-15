<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporankkModel extends Model
{
    protected $table = 'pengantar_kk';

    function getdatakk() 
    {
        return $this->findAll(); 
    }

    public function getdatakkByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tgl_pembuatan >=', $tanggal_awal)
                    ->where('tgl_pembuatan <=', $tanggal_akhir)
                    ->findAll();
    }
}
?>
