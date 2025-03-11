<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pelanggan extends BaseController
{
    public function index()
    {
        $data = array(
            'title'=>'Halaman Pelanggan',
            'isi' =>'v_halaman'
        );
        return view('layout/v_wrapper',$data);
    }
}
