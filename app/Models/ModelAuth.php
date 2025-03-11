<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table = 'user'; // Nama tabel user
    protected $allowedFields = ['username', 'password', 'full_name', 'saldo','email', 'phone', 'level', 'registered_at', 'photo','reset_token'];

    // Method untuk menyimpan data registrasi
    public function save_register($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    // Method login
    public function login($username)
    {
        // Ambil user berdasarkan username
        return $this->db->table($this->table)->where('username', $username)->get()->getRowArray();
    }
}
