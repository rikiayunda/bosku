<?php

// namespace App\Controllers;

// use App\Models\ModelAuth;
// use App\Controllers\BaseController;

// class Auth extends BaseController
// {
//     protected $modelAuth;

//     public function __construct()
//     {
//         helper('form');
//         $this->modelAuth = new ModelAuth();
        
//     }

//     public function register()
//     {
//         $data = [
//             'title' => 'Register',
//         ];
//         return view('v_register', $data);
//     }

//     // Validation and saving registration data
//     public function save_register()
//     {
//         if ($this->validate([
//             'nama_user' => 'required',
//             'username' => [
//                 'rules' => 'required|is_unique[user.username]',
//                 'errors' => [
//                     'is_unique' => 'Username sudah digunakan',
//                 ]
//             ],
//             'email' => [
//                 'rules' => 'required|valid_email|is_unique[user.email]',
//                 'errors' => [
//                     'is_unique' => 'Email sudah digunakan',
//                     'valid_email' => 'Email tidak valid',
//                 ]
//             ],
//             'no_hp' => [
//                 'rules' => 'required|numeric|is_unique[user.phone]',
//                 'errors' => [
//                     'is_unique' => 'Nomor telepon sudah digunakan',
//                     'numeric' => 'Nomor telepon harus berupa angka',
//                 ]
//             ],
//             'password' => [
//                 'rules' => 'required|min_length[4]|regex_match[/^(?=.*[A-Z]).+/]',

//                 // 'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
//                 'errors' => [
//                     'min_length' => 'Password harus minimal 8 karakter',
//                     'regex_match' => 'Password harus mengandung setidaknya satu huruf kapital dan satu angka',
//                 ]
//             ],
//             'repassword' => 'required|matches[password]',
//             'photo' => [
//                 'rules' => 'uploaded[photo]|max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg]',
//                 'errors' => [
//                     'uploaded' => 'File foto harus diupload',
//                     'max_size' => 'Ukuran file maksimal 2 MB',
//                     'is_image' => 'File yang diupload harus berupa gambar',
//                     'mime_in' => 'Format foto harus .jpg atau .jpeg',
//                 ]
//             ]
//         ])) {
//             // Mengambil file foto
//             $filePhoto = $this->request->getFile('photo');

//             // Generate nama file baru
//             $photoName = $filePhoto->getRandomName();

//             // Pindahkan file ke folder 'public/photo'
//             // $filePhoto->move('public/photo', $photoName);
//             $filePhoto->move(FCPATH . 'photo', $photoName);


//             // Jika validasi berhasil
//             $data = [
//                 'full_name' => $this->request->getPost('nama_user'),
//                 'username' => $this->request->getPost('username'),
//                 'email' => $this->request->getPost('email'),
//                 'phone' => $this->request->getPost('no_hp'),
//                 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
//                 'level' => 3, // Level 3 sebagai contoh
//                 'registered_at' => date('Y-m-d H:i:s'),
//                 'photo' => $photoName, // Menyimpan nama file foto ke database
//             ];

//             // Simpan ke database
//             $this->modelAuth->save_register($data);
//             session()->setFlashdata('pesan', 'Register Berhasil');
//             return redirect()->to(base_url('auth/register'));
//         } else {
//             // Jika validasi gagal
//             session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
//             return redirect()->to(base_url('auth/register'))->withInput();
//         }
//     }




//     public function login()
//     {
//         $data = [
//             'title' => 'Login',
//         ];
//         return view('v_login', $data);
        
//         // session()->set([
//         //     'user_id' => $user['id'],
//         //     'isLoggedIn' => true
//         // ]);
        
//     }
    

//     public function cek_login()
//     {
//         if ($this->validate([
//             'username' => 'required',
//             'password' => 'required'
//         ])) {
//             // Ambil input username dan password
//             $username = $this->request->getPost('username');
//             $password = $this->request->getPost('password');

//             // Cek data user berdasarkan username
//             $user = $this->modelAuth->login($username);

//             if ($user && password_verify($password, $user['password'])) {
//                 // Jika username dan password benar
//                 session()->set([
//                     'user_id' => $user['id'],
//                     'log' => true,
//                     'full_name' => $user['full_name'],
//                     'username' => $user['username'],
//                     'level' => $user['level'],
//                     'photo' => $user['photo'],
//                     'saldo' => $user['saldo'],
//                 ]);
               

//                 // Misalnya saldo disimpan di tabel pengguna
//         // session()->set('saldo', $user['saldo']);
//         // var_dump($user);
//         session()->regenerate();

//                 return redirect()->to(base_url('home'));
//             } else {
//                 // Jika username atau password salah
//                 session()->setFlashdata('pesan', 'Login Gagal, Username atau Password tidak cocok');
//                 return redirect()->to(base_url('auth/login'));
//             }
//         } else {
//             // Jika validasi gagal
//             session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
//             return redirect()->to(base_url('auth/login'));
//         }
        
//     }

//     public function logout()
//     {
//         session()->destroy();
//         session()->setFlashdata('pesan', 'Logout Sukses');
//         return redirect()->to(base_url('auth/login'));
//     }



//     public function lupa_password()
//     {
//         return view('v_lupaPassword');
//     }

//     public function proses_lupa_password()
//     {
//         $email = $this->request->getPost('email');
//         $modelAuth = new modelAuth();

//         // Cek apakah email ada di database
//         $user = $modelAuth->where('email', $email)->first();

//         if ($user) {
//             // Generate token
//             $token = bin2hex(random_bytes(50));

//             // Simpan token ke database atau ke tabel terpisah untuk verifikasi nanti
//             $modelAuth->update($user['id'], ['reset_token' => $token]);

//             // Kirim email
//             $this->sendResetEmail($email, $token);

//             session()->setFlashdata('pesan', 'Link reset password telah dikirim ke email Anda.');
//             return redirect()->to('auth/lupa_password');
//         } else {
//             session()->setFlashdata('errors', ['Email tidak terdaftar.']);
//             return redirect()->to('auth/lupa_password');
//         }
//     }

//     private function sendResetEmail($userEmail, $token)
//     {
//         $link = base_url("auth/reset_password/$token");
    
//         // Konfigurasi email
//         $emailService = \Config\Services::email(); // Ubah nama variabel untuk objek email service
//         $emailService->setTo($userEmail); // Gunakan $userEmail sebagai alamat email tujuan
//         $emailService->setFrom('riki16004@gmail.com', 'Aplikasi Pesan');
//         $emailService->setSubject('Reset Password');
//         $emailService->setMessage("Klik link berikut untuk mereset password Anda: $link");
    
//         if (!$emailService->send()) {
//             log_message('error', 'Email tidak dapat dikirim: ' . $emailService->printDebugger());
//         }
//     }
    

//     public function reset_password($token = null)
//     {
//         if (!$token) {
//             session()->setFlashdata('errors', ['Token tidak valid.']);
//             return redirect()->to('auth/lupa_password');
            
//         }

//         $data['token'] = $token;
//         return view('auth/reset_password', $data);
//     }

//     public function proses_reset_password()
//     {
//         $token = $this->request->getPost('token');
//         $password = $this->request->getPost('password');
//         $modelAuth = new modelAuth();

//         // Cari user berdasarkan token
//         $user = $modelAuth->where('reset_token', $token)->first();

//         if ($user) {
//             // Update password dan hapus token
//             $modelAuth->update($user['id'], [
//                 'password' => password_hash($password, PASSWORD_DEFAULT),
//                 'reset_token' => null // Hapus token setelah reset
//             ]);

//             session()->setFlashdata('pesan', 'Password berhasil direset. Silakan login.');
//             return redirect()->to('auth/login');
//         } else {
//             session()->setFlashdata('errors', ['Token tidak valid.']);
//             return redirect()->to('auth/reset_password/' . $token);
//         }
//     }
// }

namespace App\Controllers;

use App\Models\ModelAuth;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $modelAuth;

    public function __construct()
    {
        helper(['form', 'url', 'text']);
        $this->modelAuth = new ModelAuth();
        session(); // Pastikan session aktif
    }

    public function register()
    {
        $data = ['title' => 'Register'];
        return view('v_register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'nama_user' => 'required',
            'username' => 'required|is_unique[user.username]',
            'email'    => 'required|valid_email|is_unique[user.email]',
            'no_hp'    => 'required|numeric|is_unique[user.phone]',
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'min_length' => 'Password minimal 8 karakter',
                    'regex_match' => 'Password harus mengandung setidaknya satu huruf kapital dan satu angka',
                ]
            ],
            'repassword' => 'required|matches[password]',
            'photo' => 'uploaded[photo]|max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg]',
        ])) {
            // Upload Foto
            $filePhoto = $this->request->getFile('photo');
            $photoName = $filePhoto->getRandomName();
            $filePhoto->move(FCPATH . 'photo', $photoName);

            $data = [
                'full_name'      => $this->request->getPost('nama_user'),
                'username'       => $this->request->getPost('username'),
                'email'          => $this->request->getPost('email'),
                'phone'          => $this->request->getPost('no_hp'),
                'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'level'          => 3,
                'registered_at'  => date('Y-m-d H:i:s'),
                'photo'          => $photoName,
            ];

            $this->modelAuth->save_register($data);
            session()->setFlashdata('pesan', 'Registrasi berhasil, silakan login.');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

    public function login()
    {
        $data = ['title' => 'Login'];
        return view('v_login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->modelAuth->login($username);

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'user_id'   => $user['id'],
                    'log'       => true,
                    'full_name' => $user['full_name'],
                    'username'  => $user['username'],
                    'level'     => $user['level'],
                    'photo'     => $user['photo'],
                    'saldo'     => $user['saldo'],
                ]);

                session()->regenerate();
                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('pesan', 'Login gagal, periksa username atau password Anda.');
                return redirect()->to(base_url('auth/login'))->withInput();
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('pesan', 'Logout berhasil.');
        return redirect()->to(base_url('auth/login'));
    }
}
