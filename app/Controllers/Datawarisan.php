<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDatawarisan;
use App\Models\ModelKategori;

class Datawarisan extends BaseController
{
    protected $datawarisan;
    
    public function __construct()
    {
        $this->datawarisan = new ModelDatawarisan();
    }

    public function index()
    {
        $getdata = $this->datawarisan->getdata();
        $ModelKategori = new ModelKategori();
        $kategoriOptions = $ModelKategori->getKategoriOptions();
    
        if (!empty($getdata)) {
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_waris'] - $b['id_waris'];
            });
    
            $data = array(
                'datawarisan' => $getdata_array,
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        } else {
            $data = array(
                'datawarisan' => array(),
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        }
    
        return view('/datawarisan', $data);
    }
    public function search()
    {
        $keyword = $this->request->getVar('keyword'); 

        $data['keyword'] = $keyword;
       
        return view('search_result', $data);
}
}
