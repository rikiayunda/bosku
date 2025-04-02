<?php

namespace App\Controllers\Admin;

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
            'title' => 'Kelola Pencairan Dana',
            'withdrawals' => $this->withdrawalModel->findAll(),
            'isi' => 'admin/withdrawal/index',
        ];
        return view('layout/v_wrapper', $data);
    }

    // Mengubah status pencairan dari pending ke sukses
    public function approve($id)
    {
        $this->withdrawalModel->update($id, ['status' => 'success']);
        return redirect()->to('/admin/withdrawals')->with('message', 'Pencairan dana berhasil disetujui.');
    }

    // Mengunggah bukti pembayaran
    public function uploadProof($id)
    {
        $file = $this->request->getFile('payment_proof');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/payment_proof/', $newName);
            $this->withdrawalModel->update($id, ['payment_proof' => $newName]);
            return redirect()->to('/admin/withdrawals')->with('message', 'Bukti pembayaran berhasil diunggah.');
        }
        return redirect()->to('/admin/withdrawals')->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    // Menandai pencairan untuk dihapus
    public function delete($id)
    {
        $this->withdrawalModel->delete($id);
        return redirect()->to('/admin/withdrawals')->with('message', 'Pencairan dana berhasil dihapus.');
    }
}