<?php

namespace App\Controllers;


use App\Models\TanahModel;
use App\Models\ModelKategori;
use App\Controllers\BaseController;

class Kettanah extends BaseController
{
    public function index()
    {
        $tanahModel = new TanahModel();
        $ModelKategori = new ModelKategori();
    
        $data['tanahData'] = $tanahModel->findAll();
        $data['kategoriOptions'] = $ModelKategori->findAll();
    
        return view('/kettanah', $data);
    }
    protected $input;
    public function addData() 
    {
       $tanahModel = new TanahModel();
       $ModelKategori = new ModelKategori();

        $validation = \Config\Services::validation();
        $validation->setRules([
                'id_kategori_surat' => 'required',
                'identitas_pemilik' => 'required',
                'luas_tanah' => 'required',
                'bentuk_hak' => 'required',
                'status_tanah' => 'required',
                'batas_tanah' => 'required',
                'penggunaan_tanah' => 'required',
                'riwayat_transaksi' => 'required',
                'tgl_pembuatan' => 'required',
            ]);
            if ($this->request->getMethod() === 'post') {
                if (!$validation->withRequest($this->request)->run()) {
                    // Data yang sudah diisi akan tetap tersimpan
                    $data['kategoriOptions'] = $ModelKategori->findAll();
                    $data['validation'] = $validation;
                    $data['filled_data'] = $this->request->getPost();
                    return view('kettanah', $data);
                }
            $data = [
                'id_kategori_surat' => $this->request->getPost('id_kategori_surat'), 
                'identitas_pemilik' =>$this->request->getPost('identitas_pemilik'),
                'luas_tanah' =>$this->request->getPost('luas_tanah'),
                'bentuk_hak' =>$this->request->getPost('bentuk_hak'),
                'status_tanah' =>$this->request->getPost('status_tanah'),
                'batas_tanah' =>$this->request->getPost('batas_tanah'),
                'penggunaan_tanah' =>$this->request->getPost('penggunaan_tanah'),
                'riwayat_transaksi' =>$this->request->getPost('riwayat_transaksi'),
                'tgl_pembuatan' =>$this->request->getPost('tgl_pembuatan'),
            ];
            $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
            if ($kategoriInfo) {
                $data['kategori_surat'] = $kategoriInfo['kategori_surat']; // Misalnya, kolom di tabel pengantar kartu keluarga
            }
            $result = $tanahModel->insert($data);

            session()->remove('filled_data');
            if ($result) {
                return redirect()->to('/kettanah')->with('success', 'Data berhasil ditambahkan.');
            } else {
                return redirect()->to('/kettanah')->with('error', 'Terjadi kesalahan saat input data.');
            }
        }
    }

    function edit($id_tanah)
    {
        $tanahModel = new TanahModel();
        $ModelKategori = new ModelKategori();

        $tanahData = $tanahModel->find($id_tanah);
        if (!$tanahData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
        $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
            'identitas_pemilik' => $this->request->getPost('identitas_pemilik'),
            'luas_tanah' => $this->request->getPost('luas_tanah'),
            'bentuk_hak' => $this->request->getPost('bentuk_hak'),
            'status_tanah' => $this->request->getPost('status_tanah'),
            'batas_tanah' => $this->request->getPost('batas_tanah'),
            'penggunaan_tanah' => $this->request->getPost('penggunaan_tanah'),
            'riwayat_transaksi' => $this->request->getPost('riwayat_transaksi'), 
            'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'), 
        ];
        $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
        if ($kategoriInfo) {
            $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
        }
        try {
            $result = $tanahModel->update($id_tanah, $data);

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
 
   
    public function deleteData($id_tanah)
    {
        $model = new TanahModel();

        $result = $model->delete($id_tanah);
    
        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }
    
        return $this->response->setJSON($response);
    }
      
}