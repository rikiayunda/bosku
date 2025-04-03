<?php

namespace App\Controllers;

class FaqController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Panduan & FAQ | Zona Belanja',
            'isi' => 'faq_guide',
        ];

        return view('layout/v_wrapper', $data);
    }
}
