<?php

namespace App\Controllers\Admin;

use App\Models\ModelDeposit;
use App\Models\ModelTransaction;
use App\Models\UserModel;
use CodeIgniter\Controller;

class DepositController extends Controller
{
    protected $modelDeposit;
    protected $transactionModel;
    protected $userModel;

    public function __construct()
    {
        $this->modelDeposit = new ModelDeposit();
        $this->transactionModel = new ModelTransaction();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $deposits = $this->modelDeposit
            ->select('deposits.*, user.full_name')
            ->join('user', 'user.id = deposits.user_id')
            ->orderBy('deposits.created_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Daftar Deposit User',
            'deposits' => $deposits,
            'isi' => 'admin/deposit_list',
        ];

        return view('layout/v_wrapper', $data);
    }

    public function approveDeposit($id)
{
    $db = \Config\Database::connect();
    $db->transStart(); // Mulai transaksi database

    $deposit = $this->modelDeposit->find($id);

    if (!$deposit || $deposit['status'] != 'pending') {
        return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak valid.');
    }

    $userId = $deposit['user_id'];
    $nominal = (int) $deposit['nominal'];

    // Debugging: Cek ID user yang login dan ID user dari deposit
    log_message('debug', 'User login ID: ' . session()->get('id'));
    log_message('debug', 'User deposit ID: ' . $userId);

    // Update status deposit ke sukses
    $this->modelDeposit->update($id, ['status' => 'sukses']);

    // Update status transaksi terkait di tabel transactions
    $this->transactionModel
        ->where('user_id', $userId)
        ->where('amount', $nominal)
        ->where('type', 'deposit')
        ->set(['status' => 'sukses'])
        ->update();

    // Tambahkan saldo pelanggan secara aman
    $db->table('user')
        ->where('id', $userId)
        ->set('saldo', 'saldo + ' . $nominal, false)
        ->update();

    $db->transComplete(); // Commit transaksi jika sukses

    // Ambil data user yang terbaru
    $user = $this->userModel->find($userId);

    // Debugging: Log sebelum session diperbarui
    log_message('debug', 'Saldo sebelum update session: ' . session()->get('saldo'));

    // Jika user yang disetujui adalah user yang sedang login, update session
    if (session()->get('id') == $userId) {
        session()->set('saldo', $user['saldo']);

        // Debugging: Log setelah session diperbarui
        log_message('debug', 'Saldo setelah update session: ' . session()->get('saldo'));
    } else {
        log_message('error', 'Session tidak diperbarui karena ID user tidak cocok.');
    }

    return redirect()->to(base_url('admin/deposit'))->with('message', 'Deposit berhasil disetujui dan saldo pelanggan bertambah.');
}

    
    

    public function mass_action()
    {
        $action = $this->request->getPost('action');
        $deposit_ids = $this->request->getPost('deposit_ids');

        if (!$deposit_ids) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Tidak ada transaksi yang dipilih.');
        }

        foreach ($deposit_ids as $id) {
            if ($action == 'approve') {
                $this->approveDeposit($id);
            } elseif ($action == 'delete') {
                $this->delete($id);
            }
        }

        return redirect()->to(base_url('admin/deposit'))->with('message', 'Aksi massal berhasil dilakukan.');
    }

    public function update($id)
    {
        return $this->approveDeposit($id);
    }

    public function reject($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaksi database

        $deposit = $this->modelDeposit->find($id);
        if (!$deposit) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak ditemukan.');
        }

        // Update status deposit ke rejected
        $this->modelDeposit->update($id, ['status' => 'rejected']);

        // Update status transaksi terkait di tabel transactions
        $this->transactionModel
            ->where('user_id', $deposit['user_id'])
            ->where('amount', $deposit['nominal'])
            ->where('type', 'deposit')
            ->set(['status' => 'rejected'])
            ->update();

        $db->transComplete(); // Commit transaksi jika sukses

        return redirect()->to(base_url('admin/deposit'))->with('message', 'Deposit ditolak.');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaksi database

        $deposit = $this->modelDeposit->find($id);
        if (!$deposit) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak ditemukan.');
        }

        // Hapus transaksi terkait jika ada
        $this->transactionModel
            ->where('user_id', $deposit['user_id'])
            ->where('amount', $deposit['nominal'])
            ->where('type', 'deposit')
            ->delete();

        // Hapus deposit
        $this->modelDeposit->delete($id);

        $db->transComplete(); // Commit transaksi jika sukses

        return redirect()->to(base_url('admin/deposit'))->with('message', 'Riwayat deposit dihapus.');
    }
}
