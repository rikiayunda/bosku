<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'full_name','saldo', 'phone', 'email', 'username', 'password', 'skin', 'level', 'status','registered_at', 'photo', 'created_at', 'updated_at'
    ];
    public function getUserById($id)
    {
        return $this->where('id', $id)->first(); // Mengambil data pengguna berdasarkan ID
    }
}
