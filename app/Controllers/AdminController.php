<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function orders()
    {
        $orderModel = new OrderModel();
        $orders = $orderModel->findAll(); // Ambil semua pesanan

        $data = [
            'title' => 'Halaman Admin - Orders',
            'isi' => 'admin/orders',
            'orders' => $orders
        ];

        return view('layout/v_wrapper', $data);
    }

    public function approveOrder($order_id)
    {
        $orderModel = new OrderModel();
        $userModel = new UserModel();

        $order = $orderModel->find($order_id);

        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($order['status'] !== 'pending') {
            return redirect()->to('/admin/orders')->with('error', 'Pesanan sudah diproses.');
        }

        $user = $userModel->getUserById($order['user_id']);

        if (!$user) {
            return redirect()->to('/admin/orders')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Hitung saldo baru
        $saldoBaru = $user['saldo'] + $order['total_price'] + 1100000;

        // Update saldo pengguna
        $userModel->update($order['user_id'], ['saldo' => $saldoBaru]);

        // Update status order menjadi "approved"
        $orderModel->update($order_id, ['status' => 'approved']);

        return redirect()->to('/admin/orders')->with('success', 'Pesanan berhasil disetujui.');
    }


    public function deleteOrder($id)
    {
        $orderModel = new \App\Models\OrderModel();

        if ($orderModel->delete($id)) {
            return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pesanan.');
        }
    }

    public function deleteAllOrders()
    {
        $orderModel = new \App\Models\OrderModel();
        $orderIds = $this->request->getPost('order_ids'); // Ambil data dari checkbox

        if (!empty($orderIds)) {
            $orderModel->whereIn('id', $orderIds)->delete();
            return redirect()->back()->with('success', 'Pesanan yang dipilih berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada pesanan yang dipilih.');
        }
    }



    public function bulkAction()
    {
        $orderModel = new \App\Models\OrderModel();
        $orderIds = $this->request->getPost('order_ids'); // Ambil ID pesanan yang dipilih
        $action = $this->request->getPost('action');

        if (empty($orderIds)) {
            return redirect()->back()->with('error', 'Tidak ada pesanan yang dipilih.');
        }

        if ($action == "approve_all") {
            // Cek apakah order_ids benar-benar ada
            if (!is_array($orderIds) || count($orderIds) === 0) {
                return redirect()->back()->with('error', 'Data pesanan tidak valid.');
            }

            // Gunakan perulangan agar update tetap berjalan
            foreach ($orderIds as $id) {
                $orderModel->update($id, ['status' => 'approved']);
            }

            return redirect()->back()->with('success', 'Semua pesanan yang dipilih telah disetujui.');
        } elseif ($action == "delete_all") {
            $orderModel->whereIn('id', $orderIds)->delete();
            return redirect()->back()->with('success', 'Semua pesanan yang dipilih telah dihapus.');
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }

    public function editSaldo($user_id)
    {
        // var_dump("Method editSaldo dipanggil dengan user_id: ", $user_id);
        // exit;

        $userModel = new UserModel();
        $user = $userModel->find($user_id);
        // var_dump($user_id, $user);
        // exit;


        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Saldo Pengguna',
            'user' => $user,
            'isi' => 'admin/edit_saldo',
        ];

        return view('layout/v_wrapper', $data);
    }

    public function updateSaldo()
    {
        // var_dump($_POST);
        // exit;
        $userModel = new UserModel();
        $user_id = $this->request->getPost('user_id');
        $amount = $this->request->getPost('amount');
        $action = $this->request->getPost('action'); // tambah atau kurangi

        $user = $userModel->find($user_id);
        if (!$user) {
            return redirect()->to('/manage_users')->with('error', 'Pengguna tidak ditemukan.');
        }

        if (!is_numeric($amount) || $amount <= 0) {
            return redirect()->back()->with('error', 'Jumlah saldo tidak valid.');
        }

        // Update saldo berdasarkan aksi
        if ($action == 'tambah') {
            $newSaldo = $user['saldo'] + $amount;
        } elseif ($action == 'kurangi') {
            if ($user['saldo'] < $amount) {
                return redirect()->back()->with('error', 'Saldo tidak cukup untuk dikurangi.');
            }
            $newSaldo = $user['saldo'] - $amount;
        } else {
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        $userModel->update($user_id, ['saldo' => $newSaldo]);

        return redirect()->to('/manage_users')->with('success', 'Saldo pengguna berhasil diperbarui.');
    }
    public function resetSaldo()
    {
        $userModel = new UserModel();
        $user_id = $this->request->getPost('user_id');

        $user = $userModel->find($user_id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Set saldo menjadi 0
        $userModel->update($user_id, ['saldo' => 0]);

        return redirect()->to('/manage_users')->with('success', 'Saldo pengguna telah direset ke 0.');
    }

    public function changePassword($user_id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($user_id);
    
        if (!$user) {
            return redirect()->to('/manage_users')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        $data = [
            'title' => 'Ubah Sandi Pengguna',
            'user' => $user,
            'isi' => 'admin/change_password'
        ];
    
        return view('layout/v_wrapper', $data);
    }
    
    public function updatePassword()
    {
        $userModel = new UserModel();
        $user_id = $this->request->getPost('user_id');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
    
        if ($new_password !== $confirm_password) {
            return redirect()->back()->with('error', 'Konfirmasi sandi tidak cocok.');
        }
    
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
        $userModel->update($user_id, ['password' => $hashed_password]);
    
        return redirect()->to('/manage_users')->with('success', 'Sandi pengguna berhasil diperbarui.');
    }
    
}
