<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanpindahModel;

class Laporanpindah extends BaseController
{
    public function index()
    {
        $model = new LaporanpindahModel();

        // Periksa apakah form telah di-submit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            $tanggal_awal = $this->request->getPost('tanggal_awal');
            $tanggal_akhir = $this->request->getPost('tanggal_akhir');

            // Panggil method di model untuk mengambil data KTP berdasarkan periode tanggal pembuatan
            $data['datapindah'] = $model->getdatapindahByDateRange($tanggal_awal, $tanggal_akhir);
        } else {
            // Jika form belum di-submit, tampilkan semua data KTP
            $data['datapindah'] = $model->getdatapindah();
        }
        $data['activeMenu'] = 'laporanpindah';


        return view('laporanpindah', $data);
    }
}
