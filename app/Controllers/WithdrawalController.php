<?php

namespace App\Controllers;

use App\Models\WithdrawalModel;
use CodeIgniter\Controller;

class WithdrawalController extends Controller
{
    protected $withdrawalModel;

    public function __construct()
    {
        $this->withdrawalModel = new WithdrawalModel();
    }

    public function index()
    {
        $data = [ 
            'title'=>'Pencairan Dana',
            'isi'=>'withdrawal/form',

        ];
        return view('layout/v_wrapper',$data);
    }
    

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'amount'         => 'required|greater_than_equal_to[10000]',
            'bank_name' => 'required',
            'account_number' => 'required|numeric',
            'account_holder' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->withdrawalModel->save([
            'user_id' => session()->get('user_id'), // Ambil user ID dari session
            'amount' => $this->request->getPost('amount'),
            'bank_name' => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_holder' => $this->request->getPost('account_holder'),
            'status' => 'pending'
        ]);

        return redirect()->to('/withdrawal')->with('message', 'Permintaan pencairan saldo berhasil diajukan.');
    }


}

