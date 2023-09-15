<?php

namespace App\Controllers;

use App\Models\ModelDataktp;
use App\Models\ModelKategori;
use App\Controllers\BaseController;

class Dataktp extends BaseController
{
    protected $dataktp;
    
    public function __construct()
    {
        $this->dataktp = new ModelDataktp();
    }

    public function index()
    {
        $getdata = $this->dataktp->getdata();
        $ModelKategori = new ModelKategori();
        $kategoriOptions = $ModelKategori->getKategoriOptions();
    
        if (!empty($getdata)) {
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_ktp'] - $b['id_ktp'];
            });
    
            $data = array(
                'dataktp' => $getdata_array,
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        } else {
            $data = array(
                'dataktp' => array(),
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        }
    
        return view('/dataktp', $data);
    }
   
}
