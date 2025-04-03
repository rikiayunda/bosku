<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserManagement extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    // Menampilkan halaman manage users
    public function index()
    {

        $userModel = new UserModel();

        $data = array(
            'title' => 'Manage User',
            'isi' => 'manage_users',
            'user' => $this->UserModel->findAll()
        );
        return view('layout/v_wrapper', $data);
    }

    // Menampilkan form tambah user baru
    public function create()
    {
        return view('create_user');
    }

    // Menyimpan user baru ke database
    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'full_name'     => $this->request->getPost('full_name'),
            'phone'         => $this->request->getPost('phone'),
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'skin'          => $this->request->getPost('skin'),
            'level'         => $this->request->getPost('level'),
            'registered_at' => date('Y-m-d H:i:s'),
            'photo'         => $this->request->getPost('photo'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $userModel->insert($data);
        return redirect()->to('/manage_users');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        var_dump($data['user']);
        exit; // Remove this line after debugging
        return view('edit_user', $data);
    }

    

    // Hapus user
    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/manage_users');
    }




    // update profile

    // update profile
    public function profile()
    {
        $id = session()->get('id'); // Mengambil ID pengguna dari session

        // Ambil data pengguna berdasarkan ID
        $user = $this->UserModel->find($id);


        // Cek jika pengguna tidak ditemukan
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found. Please log in again.');
        }

        // Kirim data pengguna ke view
        $data = [
            'title' => 'Profile',
            'isi' => 'profile',
            'user' => $user
        ];

        return view('layout/v_wrapper', $data); // View 'profile' menampilkan form profile
    }


    // Method to fetch user data as JSON
    public function getUserData()
    {
        $id = session()->get('id'); // Get user ID from session
        $user = $this->UserModel->find($id); // Fetch user data from the database

        // Check if user data is found
        if (!$user) {
            return $this->response->setJSON(['error' => 'User not found']);
        }

        return $this->response->setJSON($user); // Return user data as JSON
    }


    // Fungsi untuk update profile
    public function updateProfile()
    {
        $id = session()->get('id'); // Mengambil ID pengguna dari session

        // Validasi form input
        $validation = $this->validate([
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'phone'     => 'required',
            'username'  => 'required',
            'photo'     => 'mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]', // Optional photo upload validation
            'password'  => 'permit_empty|min_length[8]',
            'skin'      => 'required',
            'level'     => 'required',
            'status'    => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Jika ada file photo yang di-upload
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newPhotoName = $photo->getRandomName();
            $photo->move('uploads/', $newPhotoName);
        } else {
            $newPhotoName = $this->request->getVar('current_photo'); // Tetap menggunakan photo yang lama
        }

        // Ambil data inputan dan update ke database
        $dataToUpdate = [
            'full_name' => $this->request->getVar('full_name'),
            'email'     => $this->request->getVar('email'),
            'phone'     => $this->request->getVar('phone'),
            'username'  => $this->request->getVar('username'),
            'photo'     => $newPhotoName,
            'skin'      => $this->request->getVar('skin'), // Include skin if needed
            'level'     => $this->request->getVar('level'), // Ensure you set this if applicable
            'status'    => $this->request->getVar('status'), // Ensure you handle this if needed
            'updated_at' => date('Y-m-d H:i:s'), // Update the timestamp
        ];

        // Handle password update
        if ($this->request->getVar('password')) {
            $dataToUpdate['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        // Perform the update dengan menggunakan where clause
        if (!$this->UserModel->update($id, $dataToUpdate)) {
            return redirect()->back()->withInput()->with('errors', ['Failed to update profile.']);
        }

        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }

    public function ubah($id)
    {
        $userModel = new UserModel();
        $user_get = $userModel->getUserById($id);
    
        if ($user_get) {
            $data = [
                'title'    => 'Ubah profil',
                'isi'      => 'manageuser/ubahUser',
                'user_get' => $user_get,
            ];
            return view('layout/v_wrapper', $data);
    
            // Validasi input
            $validation = \Config\Services::validation();
            $validation->setRules([
                'full_name' => 'required',
                'email'     => 'required|valid_email',
                'phone'     => 'required',
                'username'  => 'required',
                'photo'     => 'mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
                'password'  => 'permit_empty|min_length[8]',
                'skin'      => 'required',
                'level'     => 'required',
                'status'    => 'required',
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                // Tampilkan error validasi
                print_r($validation->getErrors());
                exit;
            }
    
            // Siapkan data yang akan diupdate
            $userData = [
                'full_name' => $this->request->getPost('full_name'),
                'email'     => $this->request->getPost('email'),
                'phone'     => $this->request->getPost('phone'),
                'username'  => $this->request->getPost('username'),
                'skin'      => $this->request->getPost('skin'),
                'level'     => $this->request->getPost('level'),
                'status'    => $this->request->getPost('status'),
            ];
    
            // Tambahkan kondisi untuk update password jika ada input
            if ($this->request->getPost('password')) {
                $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }
    
            // Cek apakah ada file foto yang diupload
            $photo = $this->request->getFile('photo');
            if ($photo && $photo->isValid()) {
                $photo->move('uploads/user_photos');
                $userData['photo'] = $photo->getName();
            }
    
            // Coba update manual
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            if ($builder->where('id', $id)->update($userData)) {
                session()->setFlashdata('notif', 'Data User Berhasil diubah');
                return redirect()->to('/manage_users');
            } else {
                // Menampilkan error dari database
                print_r($db->error());
                exit;
            }
        } else {
            // Jika pengguna tidak ditemukan
            return redirect()->to('/manage_users')->with('error', 'Pengguna tidak ditemukan');
        }
    }

    public function update($id)
    {
        $userModel = new UserModel();
        
        // Ambil input form
        $data = [
            'full_name'  => $this->request->getPost('full_name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'username'   => $this->request->getPost('username'),
            'skin'       => $this->request->getPost('skin'),
            'level'      => $this->request->getPost('level'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        // Cek apakah ada password baru
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
    
        // Cek apakah ada file yang diunggah

      

        $filePhoto = $this->request->getFile('photo');
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Tentukan nama file dan simpan ke folder public/uploads
            $photoName = $filePhoto->getRandomName();
            $filePhoto->move(FCPATH . 'photo', $photoName);
            
            // Tambahkan nama file ke dalam data
            $data['photo'] = $photoName;
        } else {
            // Jika tidak ada file yang diunggah, tetap gunakan foto saat ini
            $data['photo'] = $this->request->getPost('photo_current');
        }
    
        // Debugging: Tampilkan data array untuk verifikasi (sementara)
        // var_dump($data); 
        // exit;
    
        // Update user di database
        $userModel->update($id, $data);
    
        // Redirect ke halaman manage_users setelah update berhasil
        return redirect()->to('/manage_users');
    }
    

    
    

}
