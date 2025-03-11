<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MessageModel;

class Web extends BaseController
{
    protected $messageModel;
    public function __construct()
    {
        $this->messageModel = new MessageModel();
        // $this->replyModel = new ReplyModel(); // Tambahkan ini untuk menginisialisasi ReplyModel
    }
    public function index()
    
    {
    //     $data = array(
    //         'title'=>'Halaman Front End',
    //         // 'isi' =>'v_web'
    //     );
    //     return view('V_web',$data);
    // }

    $messages = $this->messageModel->findAll();
    return view('V_web', ['messages' => $messages]);
}
}