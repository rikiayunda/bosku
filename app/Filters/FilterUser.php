<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $level = session()->get('level');
        $currentURI = uri_string(); // Ambil URI saat ini

        // Jika user belum login, arahkan ke halaman login
        if (!$level) {
            session()->setFlashdata('pesan', 'Anda Belum Login!');
            return redirect()->to(base_url('auth/login'));
        }

        // Jika user (level 2) mencoba akses halaman admin, kembalikan ke home
        if ($level == 2 && strpos($currentURI, 'admin') === 0) {
            return redirect()->to(base_url('home'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $level = session()->get('level');
        $currentURI = uri_string();

        // Hanya redirect ke home jika user masih di halaman login
        if ($level == 2 && $currentURI == 'auth/login') {
            return redirect()->to(base_url('home'));
        }

        // Jika user sudah di halaman selain login atau home, biarkan saja
    }
}
