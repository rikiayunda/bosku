<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\ReplyModel;
use App\Models\ContactModel;

class Home extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel(); // Inisialisasi model di dalam constructor
    }
    public function index()
    {
        $data = array(
            'title' => 'Home',
            'isi' => 'v_home'
        );
        return view('layout/v_wrapper', $data);
    }
    public function dashboard()
    {
        $replyModel = new ReplyModel();
        // Menggunakan model untuk mengambil data dari tabel messages
        $messageModel = new MessageModel();
        $UserModel = new UserModel();
        $ContactModel = new UserModel();
        // $productModel = new ProductModel();


        // Menghitung total pesan masuk (misal berdasarkan status)
        // $total_incoming_messages = $messageModel->where('status', 'incoming')->countAllResults();
        $total_incoming_messages = $messageModel->countAllResults();
        // Menghitung total pesan keluar
        $total_outgoing_messages = $replyModel->countAllResults();
        // Menghitung total user akktif
        $total_active_users      = $UserModel->where('status', 'sent')->countAllResults();

        $failed_messages = $messageModel->where('status', 'failed')->countAllResults();

        $new_notifications = $messageModel->where('send_status', 'sent')->countAllResults();

        $total_contacts = $ContactModel->countAll();

        $data = array(
            'title' => 'Dashboard',
            'isi' => 'v_dashboard',
            'total_incoming_messages' => $total_incoming_messages,
            'total_outgoing_messages' => $total_outgoing_messages,
            'total_active_users'      => $total_active_users,
            'failed_messages'=> $failed_messages,
            'new_notifications'=> $new_notifications,
            'total_contacts' => $total_contacts,
        );
        return view('layout/v_wrapper', $data);
    }
    public function homePelanggan()
    {
        $data = [
            'title' => 'Home Pelanggan',
            'products' => $this->productModel->findAll(),
            'isi' => 'pelanggan/homePelanggan', // Pastikan view ini ada di folder pelanggan
        ];
        
        return view('layout/v_wrapper', $data);
    }
    
}
