<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        $data = array(
            'title'=>'Halaman Admin',
            'isi' =>'v_halaman'
        );
        return view('layout/v_wrapper',$data);
    }
}
