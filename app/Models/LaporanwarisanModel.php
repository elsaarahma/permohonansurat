<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanwarisanModel extends Model
{

    protected $table = 'ahli_waris';

    function getdatawarisan() 
    {
        return $this->findAll(); 
    }

    public function getdatawarisanByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tgl_pembuatan >=', $tanggal_awal)
                    ->where('tgl_pembuatan <=', $tanggal_akhir)
                    ->findAll();
    }
}
?>
