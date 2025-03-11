<?php

namespace App\Controllers;

use App\Models\ModelTransaction;
use CodeIgniter\Controller;

class TransactionController extends Controller
{
    protected $transactionModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session()->start();
        }
        $this->transactionModel = new ModelTransaction();
        
    }
    

    public function index()
    {
        
        // $session = session();
        // var_dump($session->get()); die;
        
        $user_id = session()->get('user_id'); 
        // dd(session()->get());
        if (!$user_id) {
            echo "User belum login, redirect dibatalkan.";
            die;  // Stop eksekusi untuk cek hasilnya
        }
            // return redirect()->to('auth/login'); 
            // die('User belum login, redirect dibatalkan.');
        // }
        

        $data = [
            'title' => 'Riwayat Transaksi',
            'transactions' => $this->transactionModel->getTransactionsByUser($user_id),
            // 'transactionts' => $this->transactionModel->getTransactionsByUser($user_id),
            'isi' =>'pelanggan/view_transaksi'
        ];

        return view('layout/v_wrapper', $data);
    }
    
}
