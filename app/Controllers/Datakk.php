<?php

namespace App\Controllers;

use App\Models\ModelDatakk;
use App\Models\ModelKategori;
use App\Controllers\BaseController;
use App\Models\ModelDataktp;

class Datakk extends BaseController
{
    protected $datakk;
    
    public function __construct()
    {
        $this->datakk = new ModelDatakk();
    }

    public function index()
    {
        $getdata = $this->datakk->getdata();
        $ModelKategori = new ModelKategori();
        $kategoriOptions = $ModelKategori->getKategoriOptions();
    
        if (!empty($getdata)) {
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_kk'] - $b['id_kk'];
            });
    
            $data = array(
                'datakk' => $getdata_array,
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        } else {
            $data = array(
                'datakk' => array(),
                'kategoriOptions' => $kategoriOptions, // Tambahkan variabel ini
            );
        }
    
        return view('/datakk', $data);
    }
    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new ModelDataktp();

        if (!empty($keyword)) {
            $data['dataktp'] = $model->like('nama_lengkap', $keyword)->findAll();
        } else {
            $data['dataktp'] = $model->findAll();
        }

        return view('ktp_view', $data);
    }
}
