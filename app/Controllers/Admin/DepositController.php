<?php

namespace App\Controllers\Admin;

use App\Models\ModelDeposit;
use App\Models\ModelTransaction;
use CodeIgniter\Controller;

class DepositController extends Controller
{
    protected $modelDeposit;
    protected $transactionModel;

    public function __construct()
    {
        $this->modelDeposit = new ModelDeposit();
        $this->transactionModel = new ModelTransaction();
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
        $deposit = $this->modelDeposit->find($id);

        if (!$deposit || $deposit['status'] != 'pending') {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak valid.');
        }

        // Update status deposit ke sukses
        $this->modelDeposit->update($id, ['status' => 'sukses']);

        // Tambah saldo user secara aman
        $db = \Config\Database::connect();
        $db->table('user')
            ->where('id', $deposit['user_id'])
            ->set('saldo', 'saldo + ' . (int) $deposit['nominal'], false)
            ->update();

        return redirect()->to(base_url('admin/deposit'))->with('message', 'Deposit berhasil disetujui.');
    }

    public function mass_action()
    {
        $action = $this->request->getPost('action');
        $deposit_ids = $this->request->getPost('deposit_ids');

        if (!$deposit_ids) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Tidak ada transaksi yang dipilih.');
        }

        if ($action == 'approve') {
            foreach ($deposit_ids as $id) {
                $this->modelDeposit->update($id, ['status' => 'approved']);
            }
            session()->setFlashdata('message', 'Deposit yang dipilih telah disetujui.');
        } elseif ($action == 'delete') {
            foreach ($deposit_ids as $id) {
                $this->modelDeposit->delete($id);
            }
            session()->setFlashdata('message', 'Riwayat deposit yang dipilih telah dihapus.');
        }

        return redirect()->to(base_url('admin/deposit'));
    }

    public function update($id)
    {
        $deposit = $this->modelDeposit->find($id);
        if (!$deposit) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak ditemukan.');
        }

        $this->modelDeposit->update($id, ['status' => 'approved']);
        return redirect()->to(base_url('admin/deposit'))->with('message', 'Deposit telah disetujui.');
    }

    public function reject($id)
    {
        $deposit = $this->modelDeposit->find($id);
        if (!$deposit) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak ditemukan.');
        }

        $this->modelDeposit->update($id, ['status' => 'rejected']);
        return redirect()->to(base_url('admin/deposit'))->with('message', 'Deposit ditolak.');
    }

    public function delete($id)
    {
        $deposit = $this->modelDeposit->find($id);
        if (!$deposit) {
            return redirect()->to(base_url('admin/deposit'))->with('error', 'Deposit tidak ditemukan.');
        }

        $this->modelDeposit->delete($id);
        return redirect()->to(base_url('admin/deposit'))->with('message', 'Riwayat deposit dihapus.');
    }
}
