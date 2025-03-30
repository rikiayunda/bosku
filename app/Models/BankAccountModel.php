<?php

namespace App\Models;

use CodeIgniter\Model;

class BankAccountModel extends Model
{
    protected $table = 'bank_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bank_name', 'account_number', 'account_holder', 'created_at', 'updated_at'];
}
