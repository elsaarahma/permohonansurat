<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporantanahModel;

class Laporantanah extends BaseController
{
    public function index()
    {
        $model = new LaporantanahModel();

        // Periksa apakah form telah di-submit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            $tanggal_awal = $this->request->getPost('tanggal_awal');
            $tanggal_akhir = $this->request->getPost('tanggal_akhir');

            // Panggil method di model untuk mengambil data tanah berdasarkan periode tanggal pembuatan
            $data['datatanah'] = $model->getdatatanahByDateRange($tanggal_awal, $tanggal_akhir);
        } else {
            // Jika form belum di-submit, tampilkan semua data tanah
            $data['datatanah'] = $model->getdatatanah();
        }
        $data['activeMenu'] = 'laporantanah';

        return view('laporantanah', $data);
    }
}
