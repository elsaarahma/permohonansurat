<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporandomisiliModel;

class Laporandomisili extends BaseController
{
    public function index()
    {

        $model = new LaporandomisiliModel();
        
        $data['activeMenu'] = 'laporandomisili';

        // Periksa apakah form telah di-submit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            $tanggal_awal = $this->request->getPost('tanggal_awal');
            $tanggal_akhir = $this->request->getPost('tanggal_akhir');

            // Panggil method di model untuk mengambil data KTP berdasarkan periode tanggal pembuatan
            $data['datadomisili'] = $model->getdatadomisiliByDateRange($tanggal_awal, $tanggal_akhir);
        } else {
            // Jika form belum di-submit, tampilkan semua data KTP
            $data['datadomisili'] = $model->getdatadomisili();
        }

        return view('laporandomisili', $data);
    }
}
