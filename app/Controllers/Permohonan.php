<?php

namespace App\Controllers;

use App\Models\KtpModel;
use App\Models\KkModel;
use App\Models\WarisanModel;
use App\Models\TanahModel;
use App\Models\PindahModel;
use App\Models\DomisiliModel;
class Permohonan extends BaseController
{
    public function index()
    {
        $ktpModel = new KtpModel();
        $kkModel = new KKModel();
        $warisanModel = new WarisanModel();
        $tanahModel = new TanahModel();
        $pindahModel = new PindahModel();
        $domisiliModel = new DomisiliModel();

        $data['ktp'] = $ktpModel->getPendingData();
        $data['kk'] = $kkModel->getPendingData();
        $data['ahliwaris'] = $warisanModel->getPendingData();
        $data['kettanah'] = $tanahModel->getPendingData();
        $data['pindah'] = $pindahModel->getPendingData();
        $data['domisili'] = $domisiliModel->getPendingData();
       
        return view('permohonan_pending',$data);
    }
    function disetujui()
    {
        $ktpModel = new KtpModel();
        $kkModel = new KKModel();
        $warisanModel = new WarisanModel();
        $tanahModel = new TanahModel();
        $pindahModel = new PindahModel();
        $domisiliModel = new DomisiliModel();

        $data['ktp'] = $ktpModel->getApprovedData();
        $data['kk'] = $kkModel->getApprovedData();
        $data['ahliwaris'] = $warisanModel->getApprovedData();
        $data['kettanah'] = $tanahModel->getApprovedData();
        $data['pindah'] = $pindahModel->getApprovedData();
        $data['domisili'] = $domisiliModel->getApprovedData();
       
        // Kirim data ke halaman permohonan_disetujui
        return view('permohonan_disetujui',$data);
    }
    function dibatalkan()
    {
        $ktpModel = new KtpModel();
        $kkModel = new KKModel();
        $warisanModel = new WarisanModel();
        $tanahModel = new TanahModel();
        $pindahModel = new PindahModel();
        $domisiliModel = new DomisiliModel();

        $data['ktp'] = $ktpModel->getDibatalkanData();
        $data['kk'] = $kkModel->getDibatalkanData();
        $data['ahliwaris'] = $warisanModel->getDibatalkanData();
        $data['kettanah'] = $tanahModel->getDibatalkanData();
        $data['pindah'] = $pindahModel->getDibatalkanData();
        $data['domisili'] = $domisiliModel->getDibatalkanData();
       
        return view('permohonan_dibatalkan',$data);
    }
    public function getTotalPending()
    {
        $ktpModel = new KtpModel();
        $kkModel = new KKModel();
        $warisanModel = new WarisanModel();
        $tanahModel = new TanahModel();
        $pindahModel = new PindahModel();
        $domisiliModel = new DomisiliModel();

        $totalPending = 0;

        // Hitung total status pending dari berbagai tabel
        $totalPending += count($ktpModel->getPendingData());
        $totalPending += count($kkModel->getPendingData());
        $totalPending += count($warisanModel->getPendingData());
        $totalPending += count($tanahModel->getPendingData());
        $totalPending += count($pindahModel->getPendingData());
        $totalPending += count($domisiliModel->getPendingData());

        return $totalPending;
    }
    public function getTotalDisetujui()
    {
        $ktpModel = new KtpModel();
        $kkModel = new KKModel();
        $warisanModel = new WarisanModel();
        $tanahModel = new TanahModel();
        $pindahModel = new PindahModel();
        $domisiliModel = new DomisiliModel();

        $totalDisetujui = 0;

        // Hitung total status pending dari berbagai tabel
        $totalDisetujui += count($ktpModel->getApprovedData());
        $totalDisetujui += count($kkModel->getApprovedData());
        $totalDisetujui += count($warisanModel->getApprovedData());
        $totalDisetujui += count($tanahModel->getApprovedData());
        $totalDisetujui += count($pindahModel->getApprovedData());
        $totalDisetujui += count($domisiliModel->getApprovedData());

        return $totalDisetujui;
    }
    public function getTotalDibatalkan()
    {
        $ktpModel = new KtpModel();
        $kkModel = new KKModel();
        $warisanModel = new WarisanModel();
        $tanahModel = new TanahModel();
        $pindahModel = new PindahModel();
        $domisiliModel = new DomisiliModel();

        $totalDibatalkan = 0;

        // Hitung total status pending dari berbagai tabel
        $totalDibatalkan += count($ktpModel->getApprovedData());
        $totalDibatalkan += count($kkModel->getApprovedData());
        $totalDibatalkan += count($warisanModel->getApprovedData());
        $totalDibatalkan += count($tanahModel->getApprovedData());
        $totalDibatalkan += count($pindahModel->getApprovedData());
        $totalDibatalkan += count($domisiliModel->getApprovedData());

        return $totalDibatalkan;
    }
    public function hapusData($tabel, $id)
    {
        $model = null;
        $idColumn = null;

    // Tentukan model dan nama kolom ID berdasarkan tabel yang diberikan
        switch ($tabel) {
            case 'pengantar_ktp':
                $model = new KtpModel();
                $idColumn = 'id_ktp';
                break;
                case 'pengantar_kk':
                $model = new KkModel();
                $idColumn = 'id_kk';
                break;
                case 'ahli_waris':
                $model = new WarisanModel();
                $idColumn = 'id_waris';
                break;
                case 'keterangan_tanah':
                $model = new TanahModel();
                $idColumn = 'id_tanah';
                break;
                case 'pindah_keluar':
                $model = new PindahModel();
                $idColumn = 'id_pindah_keluar';
                break;
            case 'pindah_domisili':
                $model = new DomisiliModel();
                $idColumn = 'id_domisili';
                break;
        }
        if ($model && $idColumn) {
            $model->where($idColumn, $id)->delete();
        }
        return redirect()->to(site_url('permohonan_pending'));
    }
    public function hapus($tabel, $id)
    {
        $model = null;
        $idColumn = null;

        // Tentukan model dan nama kolom ID berdasarkan tabel yang diberikan
        switch ($tabel) {
            case 'pengantar_ktp':
                $model = new KtpModel();
                $idColumn = 'id_ktp';
                break;
                case 'pengantar_kk':
                $model = new KkModel();
                $idColumn = 'id_kk';
                break;
                case 'ahli_waris':
                $model = new WarisanModel();
                $idColumn = 'id_waris';
                break;
                case 'keterangan_tanah':
                $model = new TanahModel();
                $idColumn = 'id_tanah';
                break;
                case 'pindah_keluar':
                $model = new PindahModel();
                $idColumn = 'id_pindah_keluar';
                break;
                case 'pindah_domisili':
                $model = new DomisiliModel();
                $idColumn = 'id_domisili';
                break;
        
        }

        if ($model && $idColumn) {
            $model->where($idColumn, $id)->delete();
        }

        return redirect()->to(site_url('permohonan_disetujui'));
    }
    public function delete($tabel, $id)
    {
        $model = null;
        $idColumn = null;

        // Tentukan model dan nama kolom ID berdasarkan tabel yang diberikan
        switch ($tabel) {
            case 'pengantar_ktp':
                $model = new KtpModel();
                $idColumn = 'id_ktp';
                break;
                case 'pengantar_kk':
                $model = new KkModel();
                $idColumn = 'id_kk';
                break;
                case 'ahli_waris':
                $model = new WarisanModel();
                $idColumn = 'id_waris';
                break;
                case 'keterangan_tanah':
                $model = new TanahModel();
                $idColumn = 'id_tanah';
                break;
                case 'pindah_keluar':
                $model = new PindahModel();
                $idColumn = 'id_pindah_keluar';
                break;
                case 'pindah_domisili':
                $model = new DomisiliModel();
                $idColumn = 'id_domisili';
                break;
        }
        if ($model && $idColumn) {
            $model->where($idColumn, $id)->delete();
        }
        return redirect()->to(site_url('permohonan_dibatalkan'));
    }
}