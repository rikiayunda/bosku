<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
        $data = array(
            'title'=>'Halaman Front end'
        );
        return view('v_web',$data);
    }
}
