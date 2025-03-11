<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelDeposit extends Model
{
    protected $table = 'deposits';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','bank', 'rekening', 'nominal', 'status', 'created_at'];

    // Tambahkan method untuk mengambil daftar bank
    public function getBanks()
    {
        return $this->db->table('banks')->get()->getResultArray();
    }

    // Simpan data deposit
    public function saveDeposit($data)
    {
        return $this->insert($data);
    }
}
