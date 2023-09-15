<?php 

namespace App\Controllers;

use App\Models\SuratModel;

class SuratController extends BaseController
{
    public function index()
    {
        $suratModel = new SuratModel();
        $data['permohonan_surat'] = $suratModel->getSuratData();

        // Hitung jumlah masing-masing status
        $data['jumlah_pending'] = $suratModel->where('status', 'pending')->countAllResults();
        $data['jumlah_ditolak'] = $suratModel->where('status', 'ditolak')->countAllResults();
        $data['jumlah_disetujui'] = $suratModel->where('status', 'disetujui')->countAllResults();

        return view('rekapan', $data);
    }
}

?>