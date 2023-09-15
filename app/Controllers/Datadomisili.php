<?php

namespace App\Controllers;

use App\Models\ModelDatadomisili;
use App\Models\ModelKategori;
use App\Controllers\BaseController;


class Datadomisili extends BaseController
{
    protected $datadomisili;
    
    public function __construct()
    {
        $this->datadomisili = new ModelDatadomisili();
    }

    public function index()
    {
        $getdata = $this->datadomisili->getdata();
        $ModelKategori = new ModelKategori();
        $kategoriOptions = $ModelKategori->getKategoriOptions();
    
        if (!empty($getdata)) {
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_domisili'] - $b['id_domisili'];
            });
    
            $data = array(
                'datadomisili' => $getdata_array,
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        } else {
            $data = array(
                'datadomisili' => array(),
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        }
    
        return view('/datadomisili', $data);
    }
    public function search()
    {
        $keyword = $this->request->getVar('keyword'); 

        $data['keyword'] = $keyword;
       
        return view('search_result', $data);
}
}
