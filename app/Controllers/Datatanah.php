<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDatatanah;
use App\Models\ModelKategori;

class Datatanah extends BaseController
{
    protected $datatanah;
    
    public function __construct()
    {
        $this->datatanah = new ModelDatatanah();
    }
    public function index()
    {
        $getdata = $this->datatanah->getdata();
        $ModelKategori = new ModelKategori();
        $kategoriOptions = $ModelKategori->getKategoriOptions();
    
        if (!empty($getdata)) {
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_tanah'] - $b['id_tanah'];
            });
    
            $data = array(
                'datatanah' => $getdata_array,
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        } else {
            $data = array(
                'datatanah' => array(),
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        }
    
        return view('/datatanah', $data);
    }
    public function search()
    {
        $keyword = $this->request->getVar('keyword'); 

        $data['keyword'] = $keyword;
       
        return view('search_result', $data);
}
}
