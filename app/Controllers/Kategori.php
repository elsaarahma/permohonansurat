<?php

namespace App\Controllers;
use App\Models\ModelKategori;
use App\Controllers\BaseController;

class Kategori extends BaseController
{
    protected $kategori;
    
    public function __construct()
    {
        $this->kategori = new ModelKategori();
    }

    public function index()
    {
        $getdata =  $this->kategori->getdata();
        
        if (!empty($getdata)) {
            
            $getdata_array = json_decode(json_encode($getdata), true);
            usort($getdata_array, function($a, $b) {
                return $a['id_kategori_surat'] - $b['id_kategori_surat'];
            });
            $data = array(
                'kategori'=> $getdata_array,
            );
        } else {
            $data = array(
                'kategori'=> array(), 
            );
        }
        $data=[
            'menu-active'=>"kategori",
        ];
        return view('/kategori', $data);
    }

    protected $input;
    public function addData() 
    {
       $model = new ModelKategori();
       $data = [
        'kategori_surat' =>$this->request->getPost('kategori_surat'),
       ];
       
       $result = $model->insert($data);
       if ($result) {
        return redirect()->to('/kategori')->with('success', 'Data berhasil ditambahkan.');
    } else {
        return redirect()->to('/kategori')->with('error', 'Terjadi kesalahan saat input data.');
    }
    }
   
    public function edit() 
    {
        $id_kategori_surat = $this->request->getPost('id_kategori_surat');
        $kategori_surat = $this->request->getPost('kategori_surat');

       $model = new ModelKategori();
       
       $model->edit($id_kategori_surat,$kategori_surat);
       return redirect()->to('/kategori')->with('Status','Data berhasil diperbarui');
    }
    
    public function deleteData($id_kategori_surat)
    {
        $model = new ModelKategori();

        $result = $model->delete($id_kategori_surat);
    
        if ($result) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'];
        }
    
        return $this->response->setJSON($response);
    }
    public function search()
    {
        $keyword = $this->request->getVar('keyword'); // Ambil nilai keyword dari form pencarian

        // Lakukan proses pencarian data sesuai dengan nilai keyword
        // Misalnya, gunakan model untuk melakukan pencarian berdasarkan keyword

        $data['keyword'] = $keyword;
        // Berikan data hasil pencarian ke view
        return view('search_result', $data);
    }

}
