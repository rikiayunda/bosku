<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\MessageModel;
use App\Models\ReplyModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class MessageController extends BaseController
{
    protected $messageModel;
    protected $replyModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        // $this->contactModel = new ContactModel();
        $this->replyModel = new ReplyModel(); // Tambahkan ini untuk menginisialisasi ReplyModel
    }

    // Menampilkan daftar pesan
    public function message()
    {
        $data = array(
            'title' => 'Halaman Admin',
            'isi' => 'v_message',
            'messages' => $this->messageModel->findAll()
        );

        return view('layout/v_wrapper', $data);
    }
    public function test()
    {
        $data = array(
            'title' => 'Halaman Admin',
            // 'isi' => 'v_message',
            'messages' => $this->messageModel->findAll()
        );

        return view('test', $data);
    }
    public function newMessage()
    {
        $data = array(
            'title' => 'Halaman Admin',
            'isi' => 'form_messages',
            'messages' => $this->messageModel->findAll()
        );

        return view('layout/v_wrapper', $data);
    }


    // Menampilkan form pengiriman pesan baru
    public function create()
    {
        return view('messages/form');
    }

    // Menampilkan detail pesan beserta balasan
    public function detail($id)
    {
        $message = $this->messageModel->find($id);

        if (!$message) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesan tidak ditemukan');
        }

        // Mengambil semua balasan terkait pesan ini
        $replies = $this->replyModel->where('message_id', $id)->findAll();

        return view('layout/v_wrapper', [
            'title' => 'Detail Pesan',
            'isi' => 'messages/detail', // Nama view untuk detail
            'message' => $message,
            'replies' => $replies
        ]);
    }


    // Mengirim pesan baru dan menyimpannya ke database
    public function send()
    {
        // Validasi input
        $validation = Services::validation();
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'message' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan pesan ke database
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'message' => $this->request->getPost('message')
        ];

        $this->messageModel->save($data);

        // Kirim email
        $email = Services::email();
        $email->setTo('uchihairsal@gmail.com'); // Ganti dengan email pemilik
        $email->setFrom($data['email'], $data['name']);
        $email->setSubject('New Message Received');
        $email->setMessage($data['message']);

        if ($email->send()) {
            return redirect()->back()->with('success', 'Pesan berhasil dikirim dan disimpan.');
        } else {
            return redirect()->back()->with('error', 'Pesan gagal dikirim.');
        }
    }

    // Menampilkan form balasan pesan
    public function reply($id)
    {
        $message = $this->messageModel->find($id);

        if (!$message) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesan tidak ditemukan');
        }

        return view('messages/reply', ['message' => $message]);
    }

    // Mengirim balasan dan menyimpannya ke database
    public function sendReply()
    {
        $id = $this->request->getPost('id');
        $replyMessage = $this->request->getPost('reply');

        $message = $this->messageModel->find($id);

        if (!$message) {
            return redirect()->back()->with('error', 'Pesan tidak ditemukan.');
        }

        // Simpan balasan ke database
        $this->replyModel->save([
            'message_id' => $id,
            'reply' => $replyMessage
        ]);

        // Kirim email balasan
        $email = Services::email();
        $email->setTo($message['email']);
        $email->setFrom('uchihairsal@gmail.com', 'Website Owner'); // Ganti dengan email pemilik
        $email->setSubject('Reply to Your Message');
        $email->setMessage($replyMessage);

        if ($email->send()) {
            return redirect()->to(base_url("/messages/detail/$id"))->with('success', 'Balasan berhasil dikirim.');
        } else {
            return redirect()->back()->with('error', 'Balasan gagal dikirim.');
        }
    }
    public function delete($id)
    {
        $message = $this->messageModel->find($id);

        if (!$message) {
            return redirect()->back()->with('error', 'Pesan tidak ditemukan.');
        }

        // Hapus balasan yang terkait dengan pesan tersebut terlebih dahulu
        $this->replyModel->where('message_id', $id)->delete();

        // Hapus pesan
        $this->messageModel->delete($id);

        return redirect()->to(base_url('/messages'))->with('success', 'Pesan berhasil dihapus.');
    }

    public function contact()

    {
        $ContactModel = new ContactModel();
        $contacts = $ContactModel->findAll();
        // dd($contacts);
        // $contact= $this->contactModel->find($id);
        $data = [
            // 'contact' => $ContactModel->findAll(),
            'title' => 'Contact',
            'isi' => 'v_contact',
            'contact' => $contacts
        ];

        return view('layout/v_wrapper', $data);
    }
    // Routes


// Controller (Contacts.php)
public function tambahcontact()
{
    $contactModel = new ContactModel();

    // Validasi input
    $validationRules = [
        'name'  => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email',
        'phone' => 'required|numeric|min_length[10]|max_length[15]',
    ];
    
    $validationMessages = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters long',
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Enter a valid email address',
        ],
        'phone' => [
            'required' => 'Phone number is required',
            'numeric' => 'Phone number must be numeric',
        ],
    ];

    // Validasi data
    if (!$this->validate($validationRules, $validationMessages)) {
        // Jika validasi gagal, kembalikan ke form dengan pesan error
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Data valid, simpan ke database
    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'phone' => $this->request->getPost('phone'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    // Insert data ke database
    $contactModel->insert($data);

    // Redirect kembali ke halaman kontak
    return redirect()->to('/contacts')->with('message', 'Contact successfully added');
}


}
