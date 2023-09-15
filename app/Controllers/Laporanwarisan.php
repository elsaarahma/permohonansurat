<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanwarisanModel;

class Laporanwarisan extends BaseController
{
    public function index()
    {
        $model = new LaporanwarisanModel();

        // Periksa apakah form telah di-submit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            $tanggal_awal = $this->request->getPost('tanggal_awal');
            $tanggal_akhir = $this->request->getPost('tanggal_akhir');

            
            $data['datawarisan'] = $model->getdatawarisanByDateRange($tanggal_awal, $tanggal_akhir);
        } else {
          
            $data['datawarisan'] = $model->getdatawarisan();
        }
        $data['activeMenu'] = 'laporanwarisan';

        return view('laporanwarisan', $data);
    }
}
