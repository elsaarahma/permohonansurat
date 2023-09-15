<?php

namespace App\Controllers;

use App\Models\KtpModel;
use App\Models\ModelKategori;
use App\Controllers\BaseController;

class Ktp extends BaseController
{
   
    public function index()
    {
        $ktpModel = new KtpModel();
        $ModelKategori = new ModelKategori();
    
        $data['ktpData'] = $ktpModel->findAll();
        $data['kategoriOptions'] = $ModelKategori->findAll();
        $data['defaultCategory'] = 'Surat Pengantar KTP';

        
        return view('ktp', $data);
    }
    public function addData()
    {
        $ktpModel = new KtpModel();
        $ModelKategori = new ModelKategori();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_kategori_surat' => 'required',
            'nik' => 'required|exact_length[16]',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
            'berlaku' => 'required',
            'gol_darah' => 'required',
            'tgl_pembuatan' => 'required',
        ]);

        if ($this->request->getMethod() === 'post') {
            if (!$validation->withRequest($this->request)->run()) {
                // Data yang sudah diisi akan tetap tersimpan
                $data['kategoriOptions'] = $ModelKategori->findAll();
                $data['validation'] = $validation;
                $data['filled_data'] = $this->request->getPost();
                return view('ktp', $data);
            }

            $latestRegistrationNumber = $ktpModel->selectMax('no_registrasi')->first();
            if (!$latestRegistrationNumber) {
                $nextRegistrationNumber = 'RGKTP1';
            } else {
                // Jika ada nomor registrasi sebelumnya, tambahkan 1 pada nomor tersebut
                $currentRegistrationNumber = $latestRegistrationNumber['no_registrasi'];
                preg_match('/^RGKTP(\d+)$/', $currentRegistrationNumber, $matches);
                $nextRegistrationNumber = 'RGKTP' . ($matches[1] + 1);
            }
    
            $data = [
                'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
                'no_registrasi' => $nextRegistrationNumber,
                'nik' => $this->request->getPost('nik'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'agama' => $this->request->getPost('agama'),
                'status_perkawinan' => $this->request->getPost('status_perkawinan'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
                'berlaku' => $this->request->getPost('berlaku'),
                'gol_darah' => $this->request->getPost('gol_darah'),
                'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'),
            ];

            $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
            if ($kategoriInfo) {
                $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
            }

            $result = $ktpModel->insert($data);

            session()->remove('filled_data');

            if ($result) {
                return redirect()->to('/ktp')->with('success', 'Data berhasil ditambahkan.');
            } else {
                return redirect()->to('/ktp')->with('error', 'Terjadi kesalahan saat input data.');
            }
        }
    }

    

    public function edit($id_ktp)
    {
        $ktpModel = new KtpModel();
        $ModelKategori = new ModelKategori();

        $ktpData = $ktpModel->find($id_ktp);
        if (!$ktpData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
        $data = [
            'id_kategori_surat' => $this->request->getPost('id_kategori_surat'),
            'nik' => $this->request->getPost('nik'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'agama' => $this->request->getPost('agama'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'gol_darah' => $this->request->getPost('gol_darah'),
            'tgl_pembuatan' => $this->request->getPost('tgl_pembuatan'),
            'status' => $this->request->getPost('status')
        ];
        $kategoriInfo = $ModelKategori->find($data['id_kategori_surat']);
        if ($kategoriInfo) {
            $data['kategori_surat'] = $kategoriInfo['kategori_surat'];
        }
        try {
            $result = $ktpModel->update($id_ktp, $data);

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
 
    public function deleteData($id_ktp)
    {
        $model = new KtpModel();

        $result = $model->delete($id_ktp);
    
        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }
    
        return $this->response->setJSON($response);
    }
      
      
}
