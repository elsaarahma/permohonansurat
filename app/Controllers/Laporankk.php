<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporankkModel;

class Laporankk extends BaseController
{
    public function index()
    {
        $model = new LaporankkModel();
        $data['activeMenu'] = 'laporankk';
        // Periksa apakah form telah di-submit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            $tanggal_awal = $this->request->getPost('tanggal_awal');
            $tanggal_akhir = $this->request->getPost('tanggal_akhir');

            // Panggil method di model untuk mengambil data KK berdasarkan periode tanggal pembuatan
            $data['datakk'] = $model->getdatakkByDateRange($tanggal_awal, $tanggal_akhir);
        } else {
            // Jika form belum di-submit, tampilkan semua data KK
            $data['datakk'] = $model->getdatakk();
        }
      


        return view('laporankk', $data);
    }
}
