<?php
namespace App\Models;
use CodeIgniter\Model;

class ShippingRateModel extends Model {
    protected $table = 'shipping_rates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['destination', 'cost'];
}
