<?php

namespace App\Controllers;

use App\Models\BankAccountModel;
use CodeIgniter\Controller;

class BankController extends Controller
{
    protected $bankAccountModel;

    public function __construct()
    {
        $this->bankAccountModel = new BankAccountModel();
    }

    // Menampilkan daftar rekening bank
    public function index()
    {
        $data = [
            'title' => 'Daftar Rekening Bank',
            'banks' => $this->bankAccountModel->findAll(),
            'isi' => 'bank/index',
        ];

        return view('layout/v_wrapper', $data);
    }

    // Menampilkan form tambah rekening bank
    public function create()
    {
        $data= [
            'title'=> 'Tambah Rekening Bank',
            'isi' => 'bank/create',

        ];
        return view('layout/v_wrapper',$data);
    }

    // Menyimpan data rekening bank baru
    public function store()
    {
        $this->bankAccountModel->insert([
            'bank_name'      => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_holder' => $this->request->getPost('account_holder'),
        ]);

        return redirect()->to('admin/bank')->with('success', 'Rekening bank berhasil ditambahkan!');
    }

    // Hapus rekening bank
    public function delete($id)
    {
        $this->bankAccountModel->delete($id);
        return redirect()->to('admin/bank')->with('success', 'Rekening bank berhasil dihapus!');
    }
}
