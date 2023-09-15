<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WarisanModel;
use App\Models\ModelKategori;

class Ahliwaris extends BaseController
{
    public function index()
    {
        $warisanModel = new WarisanModel();
        $kategoriModel = new ModelKategori();
    
        $data['warisanData'] = $warisanModel->findAll();
        $data['kategoriOptions'] = $kategoriModel->findAll();
    
        return view('ahliwaris', $data);
    }
    protected $input;
   
    public function addData()
    {
        $warisanModel = new WarisanModel();
        $ModelKategori = new ModelKategori();

        $validation = \Config\Services::validation();
        $validation->setRules([
                'id_kategori_surat' => 'required',
                'nama_lengkap' => 'required',
                'hubungan_keluarga' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'kewarganegaraan' => 'required',
                'no_ktp' => 'required|exact_length[16]',
                'nama_almarhum' => 'required',
                'tgl_pembuatan' => 'required',
            ]);
            if ($this->request->getMethod() === 'post') {
                if (!$validation->withRequest($this->request)->run()) {
                    // Data yang sudah diisi akan tetap tersimpan
                    $data['kategoriOptions'] = $ModelKategori->findAll();
                    $data['validation'] = $validation;
                    $data['filled_data'] = $this->request->getPost();
                    return view('ahliwaris', $data);
                }
            $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
            'nama_lengkap' =>$this->request->getPost('nama_lengkap'),
            'hubungan_keluarga' =>$this->request->getPost('hubungan_keluarga'),
            'tempat_lahir' =>$this->request->getPost('tempat_lahir'),
            'tanggal_lahir' =>$this->request->getPost('tanggal_lahir'),
            'alamat' =>$this->request->getPost('alamat'),
            'kewarganegaraan' =>$this->request->getPost('kewarganegaraan'),
            'no_ktp' =>$this->request->getPost('no_ktp'),
            'nama_almarhum' =>$this->request->getPost('nama_almarhum'),
            'tgl_pembuatan' =>$this->request->getPost('tgl_pembuatan'),
        ];  
            $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
            if ($kategoriInfo) {
                $data['kategori_surat'] = $kategoriInfo['kategori_surat']; // Misalnya, kolom di tabel pengantar kartu keluarga
            }
            $result = $warisanModel->insert($data);
            session()->remove('filled_data');
            if ($result) {
                return redirect()->to('/ahliwaris')->with('success', 'Data berhasil ditambahkan.');
            } else {
                return redirect()->to('/ahliwaris')->with('error', 'Terjadi kesalahan saat input data.');
            }
        }
    }

public function edit($id_waris)
{
    $warisanModel = new WarisanModel();
    $ModelKategori = new ModelKategori();

    $warisanData = $warisanModel->find($id_waris);
    if (!$warisanData) {
        return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }
    $data = [
        'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
        'id_waris' => $this->request->getPost('id_waris'),
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'hubungan_keluarga' => $this->request->getPost('hubungan_keluarga'),
        'tempat_lahir' => $this->request->getPost('tempat_lahir'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        'alamat' => $this->request->getPost('alamat'), 
        'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
        'no_ktp' => $this->request->getPost('no_ktp'), 
        'nama_almarhum' => $this->request->getPost('nama_almarhum'), 
        'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan')
    ];
    $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
    if ($kategoriInfo) {
        $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
    }
    try {
        $result = $warisanModel->update($id_waris, $data);

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

    public function deleteData($id_waris)
    {
        $model = new WarisanModel();

        $result = $model->delete($id_waris);

        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }

        return $this->response->setJSON($response);
    }
}

