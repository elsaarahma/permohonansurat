<?php

namespace App\Controllers;

use App\Models\ModelDatapindah;
use App\Models\ModelKategori;
use App\Controllers\BaseController;


class Datapindah extends BaseController
{
    protected $datapindah;
    
    public function __construct()
    {
        $this->datapindah = new ModelDatapindah();
    }

   
    public function index()
    {
        $getdata = $this->datapindah->getdata();
        $ModelKategori = new ModelKategori();
        $kategoriOptions = $ModelKategori->getKategoriOptions();
    
        if (!empty($getdata)) {
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_pindah_keluar'] - $b['id_pindah_keluar'];
            });
    
            $data = array(
                'datapindah' => $getdata_array,
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        } else {
            $data = array(
                'datapindah' => array(),
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        }
    
        return view('/datapindah', $data);
    }
    public function search()
    {
        $keyword = $this->request->getVar('keyword'); 

        $data['keyword'] = $keyword;
       
        return view('search_result', $data);
}
}
