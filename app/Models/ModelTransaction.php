<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaction extends Model
{
    protected $table      = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'type', 'amount', 'details', 'status', 'created_at'];

    // Ambil transaksi berdasarkan user ID
    public function getTransactionsByUser($user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->findAll();
    }
}
