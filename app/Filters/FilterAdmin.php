<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $level = session()->get('level');
        $currentURI = uri_string();

        // Jika belum login, arahkan ke login
        if (!$level) {
            session()->setFlashdata('pesan', 'Anda Belum Login!');
            return redirect()->to(base_url('auth/login'));
        }

        // Jika user bukan admin (level 1) dan mencoba akses halaman admin, kembalikan ke home
        if ($level != 1 && strpos($currentURI, 'admin') === 0) {
            return redirect()->to(base_url('home'))->with('error', 'Anda tidak memiliki akses.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $level = session()->get('level');
        $currentURI = uri_string();

        // Jika admin sudah login dan masih di halaman login, arahkan ke dashboard
        if ($level == 1 && $currentURI == 'auth/login') {
            return redirect()->to(base_url('admin/dashboard'));
        }
    }
}



// class FilterAdmin implements FilterInterface
// {
//     public function before(RequestInterface $request, $arguments = null)
//     {
//         if (!session()->get('level')) {
//             session()->setFlashdata('pesan', 'Anda Belum Login!');
//             return redirect()->to(base_url('auth/login'));
//         }

//         if (session()->get('level') != 1) {
//             return redirect()->to(base_url('home'))->with('error', 'Anda tidak memiliki akses.');
//         }
//     }

//     public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
//     {
        
//         if (session()->get('level') == 1 && uri_string() === 'auth/login') {
//             return redirect()->to(base_url('admin/dashboard'));
//         }

       
//         if (session()->get('level') != 1 && strpos(uri_string(), 'admin') === 0) {
//             return redirect()->to(base_url('home'));
//         }
//     }
// }
