<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterPelanggan implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('level') == "") {
            session()->setFlashdata('pesan', 'Anda Belum Login!');
            return redirect()->to(base_url('auth/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
{
    // Debugging: Lihat isi sesi
    // d(session()->get()); exit;

    $allowedRoutes = ['checkout', 'checkout/process'];
    $uri = service('uri')->getPath();

    if (session()->get('level') == 3 && !in_array($uri, $allowedRoutes) && !str_starts_with($uri, 'checkout/')) {
        return redirect()->to(base_url('home'));
    }
}

}    
