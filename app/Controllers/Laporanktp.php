<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanktpModel;

class Laporanktp extends BaseController
{
    public function index()
    {
        $model = new LaporanktpModel();
        

        // Periksa apakah form telah di-submit dengan metode POST
        if ($this->request->getMethod() === 'post') {
            $tanggal_awal = $this->request->getPost('tanggal_awal');
            $tanggal_akhir = $this->request->getPost('tanggal_akhir');

            // Panggil method di model untuk mengambil data KTP berdasarkan periode tanggal pembuatan
            $data['dataktp'] = $model->getdataktpByDateRange($tanggal_awal, $tanggal_akhir);
        } else {
            // Jika form belum di-submit, tampilkan semua data KTP
            $data['dataktp'] = $model->getdataktp();
        }
 
        $menu['menu_active']= "Permohonan Surat";
        $menu['sub_menu_active']="Laporan KTP";
        return view('laporanktp',  ['dataktp' => $data,'menu'=>$menu]);
    }
}
