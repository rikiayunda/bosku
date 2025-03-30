<?php
namespace App\Models;
use CodeIgniter\Model;

class PaymentModel extends Model {
    protected $table = 'payments';
    protected $allowedFields = ['order_id', 'bank_account_id', 'amount', 'proof_of_payment', 'status'];
}
