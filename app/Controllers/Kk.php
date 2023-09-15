<?php

namespace App\Controllers;

use App\Models\KkModel;
use App\Controllers\BaseController;
use App\Models\ModelKategori;

class Kk extends BaseController
{
    public function index()
    {
        $kkModel = new KkModel();
        $kategoriModel = new ModelKategori();
    
        $data['kkData'] = $kkModel->findAll();
        $data['kategoriOptions'] = $kategoriModel->findAll();
    
        return view('kk', $data);
    }
    protected $input;
    public function addData()
    {
        $kkModel = new KkModel();
        $ModelKategori = new ModelKategori();

        $validation = \Config\Services::validation();
        $validation->setRules([
                'id_kategori_surat' => 'required',
                'nama_kk' => 'required',
                'nik_kk' => 'required|exact_length[16]',
                'alamat' => 'required',
                'desa_kelurahan' => 'required',
                'kecamatan' => 'required',
                'kabupaten_kota' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
                'jml_anggota' => 'required',
                'tujuan' => 'required',
                'tgl_pembuatan' => 'required',
            ]);
            if ($this->request->getMethod() === 'post') {
                if (!$validation->withRequest($this->request)->run()) {
                    // Data yang sudah diisi akan tetap tersimpan
                    $data['kategoriOptions'] = $ModelKategori->findAll();
                    $data['validation'] = $validation;
                    $data['filled_data'] = $this->request->getPost();
                    return view('kk', $data);
                }
            $data = [
                'id_kategori_surat' => $this->request->getPost('id_kategori_surat'), 
                'nama_kk' => $this->request->getPost('nama_kk'),
                'nik_kk' => $this->request->getPost('nik_kk'),
                'alamat' => $this->request->getPost('alamat'),
                'desa_kelurahan' => $this->request->getPost('desa_kelurahan'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kabupaten_kota' => $this->request->getPost('kabupaten_kota'),
                'provinsi' => $this->request->getPost('provinsi'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'jml_anggota' => $this->request->getPost('jml_anggota'),
                'tujuan' => $this->request->getPost('tujuan'),
                'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'),
            ];  
            $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
            if ($kategoriInfo) {
                $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
            }
            $result = $kkModel->insert($data);

            session()->remove('filled_data');
            if ($result) {
                return redirect()->to('/kk')->with('success', 'Data berhasil ditambahkan.');
            } else {
                return redirect()->to('/kk')->with('error', 'Terjadi kesalahan saat input data.');
            }
        }
    }

    public function edit($id_kk)
    {
        $kkModel = new KkModel();
        $ModelKategori = new ModelKategori();

        $kkData = $kkModel->find($id_kk);
        if (!$kkData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
        $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
            'nama_kk' => $this->request->getPost('nama_kk'),
            'nik_kk' => $this->request->getPost('nik_kk'),
            'alamat' => $this->request->getPost('alamat'),
            'desa_kelurahan' => $this->request->getPost('desa_kelurahan'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten_kota' => $this->request->getPost('kabupaten_kota'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kode_pos' => $this->request->getPost('kode_pos'), 
            'jml_anggota' => $this->request->getPost('jml_anggota'), 
            'tujuan' => $this->request->getPost('tujuan'),
            'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'),
        ];
        $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
        if ($kategoriInfo) {
            $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
        }
        try {
            $result = $kkModel->update($id_kk, $data);

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
 
    public function deleteData($id_kk)
    {
        $model = new KkModel();

        $result = $model->delete($id_kk);
    
        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }
    
        return $this->response->setJSON($response);
    }
      
}
