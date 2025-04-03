<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaderboardModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['username', 'total_komisi'];
    
    public function getTopUsers()
    {
        return $this->orderBy('total_komisi', 'DESC')
                    ->limit(10)
                    ->findAll();
    }
}
