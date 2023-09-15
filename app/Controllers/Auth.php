<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('/dashboard'));
        }

        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }
    public function register_process()
    {
        {
            if (!$this->validate([
                'user_nama' => [
                    'rules' => 'required|min_length[5]|max_length[20]',
                    'errors' => [
                        'required'  => '{field} Harus diisi',
                        'min_length'  => '{field} Minimal 5 karakter',
                        'max_length'  => '{field} Maksimal 20 karakter',
                    ]
                ],
                'user_username' => [
                    'rules' => 'required|min_length[5]|max_length[20]|is_unique[users.user_username]',
                    'errors' => [
                        'required'  => '{field} Harus diisi',
                        'min_length'  => '{field} Minimal 5 karakter',
                        'max_length'  => '{field} Maksimal 20 karakter',
                        'is_unique'  => 'Username sudah digunakan sebelumnya',
                    ]
                ],
                'user_pass' => [
                    'rules' => 'required|min_length[8]|max_length[60]',
                    'errors' => [
                        'required'  => '{field} Harus diisi',
                        'min_length'  => '{field} Minimal 8 karakter',
                        'max_length'  => '{field} Maksimal 60 karakter',
                    ]
                ],
                
                'user_email' => [
                    'rules' => 'required|valid_email|max_length[20]',
                    'errors' => [
                        'required'  => '{field} Harus diisi',
                        'valid_email'  => 'Email tidak valid',
                        'max_length'  => '{field} Maksimal 20 karakter',
                    ]
                ],
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $user = new UsersModel();
            $user->insert([
                'user_nama'  => $this->request->getVar('user_nama'),
                'user_username'  => $this->request->getVar('user_username'),
                'user_pass'  => password_hash($this->request->getVar('user_username'), PASSWORD_BCRYPT),
                'user_email'  => $this->request->getVar('user_email'),
            ]);
            return redirect()->to('login');
    }  
}
    public function forgot_pass()
    {
    return view('forgot_pass');
    }

    public function login_process()
    {
        $users = new UsersModel();
        $username = $this->request->getVar('user_username');
        $pass = $this->request->getVar('user_pass');
    
        // Validasi form
        if (empty($username) || empty($pass)) {
            session()->setFlashdata('error', 'Username dan Password harus diisi.');
            return redirect()->to(base_url('/login'));
        }
    
        // Cari akun berdasarkan username di database
        $user = $users->where(['user_username' => $username])->first();
    
        if ($user) {
            // Verifikasi password
            if (password_verify($pass, $user['user_pass'])) {
                // Set user session data
                session()->set([
                    'user_id' => $user['user_id'],
                    'username' => $user['user_username'],
                    'name' => $user['user_nama'],
                    'logged_in' => TRUE,
                ]);
                return redirect()->to(base_url('/dashboard'));
            } else {
                session()->setFlashdata('error', 'Password yang Anda masukkan salah.');
            }
        } else {
            session()->setFlashdata('error', 'Akun dengan username tersebut tidak ditemukan.');
        }
        return redirect()->to(base_url('/login'));
    }
    
    public function logout()
    { 
    session()->destroy();
    return redirect()->to(base_url('/login'));
    }

    public function dashboard()
    {
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('/login'));
    }
    $permohonanController = new Permohonan();
    $totalPending = $permohonanController->getTotalPending();
    $totalDisetujui = $permohonanController->getTotalDisetujui();
    $totalDibatalkan = $permohonanController->getTotalDibatalkan();
    $data['totalPending'] = $totalPending;
    $data['totalDisetujui'] = $totalDisetujui;
    $data['totalDibatalkan'] = $totalDibatalkan;
    $menu['menu_active']= "Dashboard";
    return view('dashboard',$data,$menu);
    }
    
}