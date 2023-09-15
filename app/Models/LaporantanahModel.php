<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporantanahModel extends Model
{

    protected $table = 'keterangan_tanah';

    function getdatatanah() 
    {
        return $this->findAll(); 
    }

    public function getdatatanahByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tgl_pembuatan >=', $tanggal_awal)
                    ->where('tgl_pembuatan <=', $tanggal_akhir)
                    ->findAll();
    }
}
?>
