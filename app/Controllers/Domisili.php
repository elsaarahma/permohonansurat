<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;
use App\Models\DomisiliModel;

class Domisili extends BaseController
{
    public function index()
    {
        
        $Model = new DomisiliModel();
        $kategoriModel = new ModelKategori();
    
        $data['domisiliData'] = $Model->findAll();
        $data['kategoriOptions'] = $kategoriModel->findAll();
    
        return view('/domisili', $data);
    }
    protected $input;
    public function addData() 
    {
       $Model = new DomisiliModel();
       $ModelKategori = new ModelKategori();

       $validation = \Config\Services::validation();
       $validation->setRules([
           'id_kategori_surat' => 'required',
           'nama_pemohon' => 'required',
           'nik' => 'required|exact_length[16]',
           'alamat_lama' => 'required',
           'alamat_baru' => 'required',
           'alasan_pindah' => 'required',
           'jml_anggota' => 'required',
           'tgl_pembuatan' => 'required',
        ]);
        if ($this->request->getMethod() === 'post') {
            if (!$validation->withRequest($this->request)->run()) {
                // Data yang sudah diisi akan tetap tersimpan
                $data['kategoriOptions'] = $ModelKategori->findAll();
                $data['validation'] = $validation;
                $data['filled_data'] = $this->request->getPost();
                return view('domisili', $data);
            }
       $data = [
        'id_kategori_surat' =>$this->request->getPost('id_kategori_surat'),
        'nama_pemohon' =>$this->request->getPost('nama_pemohon'),
        'nik' =>$this->request->getPost('nik'),
        'alamat_lama' =>$this->request->getPost('alamat_lama'),
        'alamat_baru' =>$this->request->getPost('alamat_baru'),
        'tanggal_pindah' =>$this->request->getPost('tanggal_pindah'),
        'alasan_pindah' =>$this->request->getPost('tanggal_pindah'),
        'jml_anggota' =>$this->request->getPost('jml_anggota'),
        'tgl_pembuatan' =>$this->request->getPost('tgl_pembuatan'),
       ];

    $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
    if ($kategoriInfo) {
        $data['kategori_surat'] = $kategoriInfo['kategori_surat']; // Misalnya, kolom di tabel pengantar kartu keluarga
    }
    $result = $Model->insert($data);

    session()->remove('filled_data');
    if ($result) {
        return redirect()->to('/domisili')->with('success', 'Data berhasil ditambahkan.');
    } else {
        return redirect()->to('/domisili')->with('error', 'Terjadi kesalahan saat input data.');
    }
}
}
    public function edit($id_domisili)
    {
        $Model = new DomisiliModel();
        $ModelKategori = new ModelKategori();

        $domisiliData = $Model->find($id_domisili);
        if (!$domisiliData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
        $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
            'nama_pemohon' => $this->request->getPost('nama_pemohon'),
            'nik' => $this->request->getPost('nik'),
            'alamat_lama' => $this->request->getPost('alamat_lama'),
            'alamat_baru' => $this->request->getPost('alamat_baru'),
            'tanggal_pindah' => $this->request->getPost('tanggal_pindah'), 
            'alasan_pindah' => $this->request->getPost('alasan_pindah'),
            'jml_anggota' => $this->request->getPost('jml_anggota'), 
            'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'), 
        ];

        $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
        if ($kategoriInfo) {
            $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
        }
        try {
            $result = $Model->update($id_domisili, $data);

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

    public function deleteData($id_domisili)
    {
        $model = new DomisiliModel();

        $result = $model->delete($id_domisili);
    
        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }
    
        return $this->response->setJSON($response);
    }
      
}

