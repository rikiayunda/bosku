<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductsController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search'); // Ambil data pencarian dari input GET
    
        if (!empty($search)) {
            // Jika ada pencarian, filter data berdasarkan ID atau Nama Barang
            $products = $this->productModel
                ->like('id', $search)
                ->orLike('name', $search)
                ->findAll();
        } else {
            // Jika tidak ada pencarian, ambil semua produk
            $products = $this->productModel->findAll();
        }
    
        $data = [
            'title' => 'Kelola Produk',
            'products' => $products,
            'search' => $search, // Simpan nilai pencarian agar input tetap terisi
            'isi' => 'admin/products/index',
        ];
    
        return view('layout/v_wrapper', $data);
    }
    

    public function create()
    {
        $data = [
            'title' => 'Tambahkan Produk',
            // 'products' => $this->productModel->findAll(),
            'isi' => 'admin/products/create',
        ];
        return view('layout/v_wrapper', $data);
        // return view('admin/products/create', ['title' => 'Tambah Produk']);
    }

    public function store()
    {
        $image = $this->request->getFile('image'); // Ambil file yang diunggah
    
        if ($image->isValid() && !$image->hasMoved()) {
            // Generate nama unik untuk gambar
            $imageName = $image->getRandomName();
            // Pindahkan gambar ke folder "uploads"
            $image->move('uploads', $imageName);
        } else {
            // Jika tidak ada gambar diunggah, berikan nilai default atau tampilkan error
            $imageName = null;
        }
    
        // Simpan data ke database
        $this->productModel->save([
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName, // Simpan nama file gambar
        ]);
    
        return redirect()->to(site_url('admin/products'))->with('message', 'Produk berhasil ditambahkan.');
    }
    

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/admin/products')->with('error', 'Produk tidak ditemukan.');
        }

        // Data untuk dikirim ke tampilan
        $data = [
            'title' => 'Edit Produk',
            'product' => $product,
            'isi' => 'admin/products/edit'
        ];

        return view('layout/v_wrapper', $data);
    }


    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            // Update produk
            $this->productModel->update($id, [
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'description' => $this->request->getPost('description'),
                'image' => $this->request->getFile('image'),
            ]);


            // Ambil data terbaru setelah update
            $data = [
                'title' => 'Edit Produk',
                'product' => $this->productModel->find($id), // Ambil ulang produk yang sudah diperbarui
                'isi' => 'admin/products/edit',
                'message' => 'Produk berhasil diperbarui.' // Pesan sukses
            ];

            return view('layout/v_wrapper', $data);
        }

        // Jika tidak ada update, tampilkan form edit biasa
        $data = [
            'title' => 'Edit Produk',
            'product' => $this->productModel->find($id),
            'isi' => 'admin/products/edit'
        ];

        return view('layout/v_wrapper', $data);
    }


    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/admin/products')->with('message', 'Produk berhasil dihapus.');
    }
}
