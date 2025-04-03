<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        // Mendapatkan informasi pengguna yang sedang login
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        if (!isset($user['total_bonus'])) {
            $user['total_bonus'] = 0;
        }
        $referral_link = base_url() . '/' . ($user['username'] ?? 'N/A');


        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Referral Bonus',
            'user' => $user,
            'referral_link' => $referral_link,
            'isi' => 'referral_bonus',
        ];

        return view('layout/v_wrapper', $data);
    }

    public function sendInvite()
    {
        // Mengambil email teman yang diundang
        $email = $this->request->getPost('friend_email');
        
        // Memvalidasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session()->setFlashdata('error', 'Email tidak valid.');
            return redirect()->back();
        }

        // Mengambil informasi pengguna yang sedang login
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        // Kirim email undangan kepada teman
        // Misalnya, menggunakan layanan email dari CodeIgniter
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('no-reply@yourdomain.com', 'Referral Program');
        $emailService->setSubject('Undangan Bergabung di Program Referral');
        $emailService->setMessage("Halo, \n\nKami mengundang Anda untuk bergabung dengan platform kami menggunakan kode referral: " . $user['referral_code'] . "\n\nSelamat bergabung!");

        // Jika pengiriman email berhasil
        if ($emailService->send()) {
            session()->setFlashdata('message', 'Undangan berhasil dikirim!');
        } else {
            session()->setFlashdata('error', 'Gagal mengirim undangan.');
        }

        return redirect()->to('/referral');
    }

    public function updateBonus()
    {
        // Mendapatkan total bonus pengguna
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        // Update bonus komisi jika perlu
        // Misalnya, setiap kali teman bergabung dan melakukan transaksi, bonus pengguna bertambah
        $bonus = $user['total_bonus'] + 50000; // Contoh bonus untuk setiap teman yang bergabung
        $userModel->update($user['id'], ['total_bonus' => $bonus]);

        // Kembali ke halaman referral dengan informasi terbaru
        session()->setFlashdata('message', 'Bonus komisi diperbarui.');
        return redirect()->to('/referral');
    }
}
