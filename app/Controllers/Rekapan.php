<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;
use App\Models\PermohonanSuratModel;
use App\Models\KtpModel;
use App\Models\KkModel;
use App\Models\WarisanModel;
use App\Models\TanahModel;
use App\Models\PindahModel;
use App\Models\DomisiliModel;

class Rekapan extends BaseController
{
    public function index()
    {

        $modelKategori = new ModelKategori();
        $permohonanSuratModel = new PermohonanSuratModel();
        $KtpModel = new KtpModel();
        $KkModel = new KkModel();
        $WarisanModel = new WarisanModel();
        $TanahModel = new TanahModel();
        $PindahModel = new PindahModel();
        $DomisiliModel = new DomisiliModel();

        $kategoriSurat = $modelKategori->findAll();

        $data = [];
        
        foreach ($kategoriSurat as $kategori) {
            $kategoriId = $kategori['id_kategori_surat'];
    
            $jumlahPending = $permohonanSuratModel->getJumlahStatusByKategori($kategoriId, 'pending');
            $jumlahDisetujui = $permohonanSuratModel->getJumlahStatusByKategori($kategoriId, 'disetujui');
            $jumlahDibatalkan = $permohonanSuratModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan');

            $totalPending = $jumlahPending + $KtpModel->getJumlahStatusByKategori($kategoriId, 'pending') + $KkModel->getJumlahStatusByKategori($kategoriId, 'pending') + $WarisanModel->getJumlahStatusByKategori($kategoriId, 'pending') + $TanahModel->getJumlahStatusByKategori($kategoriId, 'pending') + $PindahModel->getJumlahStatusByKategori($kategoriId, 'pending') + $DomisiliModel->getJumlahStatusByKategori($kategoriId, 'pending');

            $totalDisetujui = $jumlahDisetujui + $KtpModel->getJumlahStatusByKategori($kategoriId, 'disetujui') + $KkModel->getJumlahStatusByKategori($kategoriId, 'disetujui') + $WarisanModel->getJumlahStatusByKategori($kategoriId, 'disetujui') + $TanahModel->getJumlahStatusByKategori($kategoriId, 'disetujui') + $PindahModel->getJumlahStatusByKategori($kategoriId, 'disetujui') + $DomisiliModel->getJumlahStatusByKategori($kategoriId, 'disetujui');

            $totalDibatalkan = $jumlahDibatalkan + $KtpModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan') + $KkModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan') + $WarisanModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan') + $TanahModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan') + $PindahModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan') + $DomisiliModel->getJumlahStatusByKategori($kategoriId, 'dibatalkan');

            $data[$kategoriId] = [
                'kategori' => $kategori['kategori_surat'],
                'pending' => $totalPending,
                'disetujui' => $totalDisetujui,
                'dibatalkan' => $totalDibatalkan,
                'total' => $totalPending + $totalDisetujui + $totalDibatalkan,
            ];
    }
    $menu['menu_active']= "Permohonan Surat";
    $menu['sub_menu_active']="Rekapan";
        return view('rekapan', ['data' => $data,'menu'=>$menu]);
    }
}
?>
