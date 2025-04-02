<?php

namespace App\Models;

use CodeIgniter\Model;

class WithdrawalModel extends Model
{
    protected $table = 'withdrawals';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'amount', 'status', 'bank_name', 'account_number', 'account_holder', 'created_at', 'updated_at'];
}
