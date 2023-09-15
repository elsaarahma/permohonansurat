<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanpindahModel extends Model
{
    protected $table = 'pindah_keluar';

    function getdatapindah() 
    {
        return $this->findAll(); 
    }

    public function getdatapindahByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tanggal_dibuat >=', $tanggal_awal)
                    ->where('tanggal_dibuat <=', $tanggal_akhir)
                    ->findAll();
    }
}
?>
