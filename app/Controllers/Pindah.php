<?php

namespace App\Controllers;

use App\Models\PindahModel;
use App\Models\ModelKategori;
use App\Controllers\BaseController;

class Pindah extends BaseController
{
    public function index()
    {
        $pindahModel = new PindahModel();
        $kategoriModel = new ModelKategori();
    
        $data['pindahData'] = $pindahModel->findAll();
        $data['kategoriOptions'] = $kategoriModel->findAll();
    
        return view('pindah', $data);
    }
    protected $input;
    public function addData()
    {
        $pindahModel = new PindahModel();
        $ModelKategori = new ModelKategori();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_kategori_surat' => 'required',
            'nama_pemohon' => 'required',
            'no_kk' => 'required|exact_length[16]',
            'no_nik' => 'required|exact_length[16]',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_asal' => 'required',
            'alamat_tujuan' => 'required',
            'jml_anggota' => 'required',
            'tujuan' => 'required',
            'tanggal_dibuat' => 'required',
            'tempat_dibuat' => 'required',
        ]);
        if ($this->request->getMethod() === 'post') {
            if (!$validation->withRequest($this->request)->run()) {
                // Data yang sudah diisi akan tetap tersimpan
                $data['kategoriOptions'] = $ModelKategori->findAll();
                $data['validation'] = $validation;
                $data['filled_data'] = $this->request->getPost();
                return view('pindah', $data);
            }
            $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'), 
            'nama_pemohon' =>$this->request->getPost('nama_pemohon'),
            'no_kk' =>$this->request->getPost('no_kk'),
            'no_nik' =>$this->request->getPost('no_nik'),
            'tempat_lahir' =>$this->request->getPost('tempat_lahir'),
            'tanggal_lahir' =>$this->request->getPost('tanggal_lahir'),
            'alamat_asal' =>$this->request->getPost('alamat_asal'),
            'alamat_tujuan' =>$this->request->getPost('alamat_tujuan'),
            'jml_anggota' =>$this->request->getPost('jml_anggota'),
            'tujuan' =>$this->request->getPost('tujuan'),
            'tanggal_dibuat' =>$this->request->getPost('tanggal_dibuat'),
            'tempat_dibuat' =>$this->request->getPost('tempat_dibuat'),
        ];  
        $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
        if ($kategoriInfo) {
            $data['kategori_surat'] = $kategoriInfo['kategori_surat']; // Misalnya, kolom di tabel pengantar kartu keluarga
        }
        $result = $pindahModel->insert($data);

        session()->remove('filled_data');
        if ($result) {
            return redirect()->to('/pindah')->with('success', 'Data berhasil ditambahkan.');
        } else {
            return redirect()->to('/pindah')->with('error', 'Terjadi kesalahan saat input data.');
        }
        }
    } 

    public function edit($id_pindah_keluar)
    {
        $Model = new PindahModel();
        $ModelKategori = new ModelKategori();

        $pindahData = $Model->find($id_pindah_keluar);
        if (!$pindahData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
        $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
            'nama_pemohon' => $this->request->getPost('nama_pemohon'),
            'no_kk' => $this->request->getPost('no_kk'),
            'no_nik' => $this->request->getPost('no_nik'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat_asal' => $this->request->getPost('alamat_asal'),
            'alamat_tujuan' => $this->request->getPost('alamat_tujuan'),
            'jml_anggota' => $this->request->getPost('jml_anggota'),
            'tujuan' => $this->request->getPost('tujuan'),
            'tanggal_dibuat' => $this->request->getPost('tanggal_dibuat'),
            'tempat_dibuat' => $this->request->getPost('tempat_dibuat'),
            'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'), 
         ];

        $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
        if ($kategoriInfo) {
            $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
        }
        try {
            $result = $Model->update($id_pindah_keluar, $data);

            if ($result) {
                $response = ['success' => true, 'message' => 'Data berhasil diupdate.'];
            } else {
                $response = ['success' => false, 'message' => 'Tidak ada perubahan data atau terjadi kesalahan.'];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
        return $this->response->setJSON($response);
    }

    public function deleteData($id_pindah_keluar)
    {
        $pindahmodel = new PindahModel();

        $result = $pindahmodel->delete($id_pindah_keluar);

        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }

        return $this->response->setJSON($response);
    }  
}
