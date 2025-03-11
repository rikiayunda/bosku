<?php 

namespace App\Controllers;

use App\Models\ModelTransaction;
use App\Models\ModelDeposit;
use CodeIgniter\Controller;

class DepositController extends Controller
{
    protected $modelDeposit;
    protected $transactionModel;

    public function __construct()
    {
        helper(['form', 'text']); // Load helper tambahan
        $this->modelDeposit = new ModelDeposit();
        $this->transactionModel = new ModelTransaction();
        
    }
    

    // Halaman formulir deposit
    public function deposit()
    {
        $data = [
            'title' => 'Deposit',
            'banks' => $this->modelDeposit->getBanks(),
            'isi' => 'pelanggan/view_deposit',
        ];
        return view('layout/v_wrapper', $data);
    }

    // Proses formulir deposit
    public function submit()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'bank' => 'required',
            'rekening' => 'required|numeric',
            'nominal' => 'required|numeric|min_length[4]|greater_than[0]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('deposit'))->withInput();
        }

        $db = \Config\Database::connect(); // Ambil koneksi database
        $db->transStart(); // Mulai transaksi

        try {
            $userId = session()->get('user_id');
            $bank = esc($this->request->getPost('bank'));
            $rekening = esc($this->request->getPost('rekening'));
            $nominal = esc($this->request->getPost('nominal'));

            // Data deposit
            $depositData = [
                'user_id' => $userId,
                'bank' => $bank,
                'rekening' => $rekening,
                'nominal' => $nominal,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->modelDeposit->insert($depositData);

            // Data transaksi
            $transactionData = [
                'user_id' => $userId,
                'type' => 'deposit',
                'amount' => $nominal,
                'details' => "Deposit ke {$bank} - Rekening: {$rekening}",
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            if (!$this->transactionModel->insert($transactionData)) {
                throw new \Exception('Gagal menyimpan transaksi');
            }

            $db->transComplete(); // Commit transaksi jika sukses
            session()->setFlashdata('message', 'Deposit berhasil diajukan.');
            return redirect()->to(base_url('transaksi'));

        } catch (\Exception $e) {
            $db->transRollback(); // Rollback jika terjadi kesalahan
            log_message('error', 'Deposit gagal: ' . $e->getMessage()); 
            session()->setFlashdata('error', 'Terjadi kesalahan saat memproses deposit.');
            return redirect()->to(base_url('deposit'))->withInput();
        }
    }

    public function success()
    {
        return view('pelanggan/view_deposit_success');
    }
}
