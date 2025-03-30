<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders';
    protected $allowedFields = ['user_id', 'total_price', 'shipping_address', 'shipping_cost', 'bank_account_id', 'payment_status'];
}
