<?php

namespace App\Controllers;

class SupportController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Support & Bantuan | Zona Belanja',
            'isi'=>'support_help',
        ];

        return view('layout/v_wrapper', $data);
    }
}
