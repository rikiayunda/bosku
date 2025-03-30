<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ShippingRateModel;
use App\Models\PaymentModel;
use App\Models\BankAccountModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Checkout extends BaseController
{
    public function index($productId = null)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$productId) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan!');
        }

        $productModel = new ProductModel();
        $shippingModel = new ShippingRateModel();
        $bankModel = new BankAccountModel();

        $product = $productModel->find($productId);
        if (!$product) {
            return redirect()->to('/dashboard')->with('error', 'Produk tidak ditemukan di database!');
        }

        $cart = session()->get('cart') ?? [];
        $cart[$productId] = [
            'price' => (float) $product['price'],
            'quantity' => 1
        ];
        session()->set('cart', $cart);

        $data = [
            'title'          => 'Checkout',
            'product'        => $product,
            'shipping_rates' => $shippingModel->findAll(),
            'bank_accounts'  => $bankModel->findAll(),
            'isi'            => 'checkout/index',
        ];

        return view('layout/v_wrapper', $data);
    }

    public function process()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $shippingModel = new ShippingRateModel();

        $shipping_address = $this->request->getPost('shipping_address');
        $shipping_id = $this->request->getPost('shipping_id');
        $bank_account_id = $this->request->getPost('bank_account_id');

        $shipping = $shippingModel->find($shipping_id);
        $shipping_cost = $shipping ? $shipping['cost'] : 0;

        $cart = session()->get('cart');
        if (!$cart || empty($cart)) {
            return redirect()->to('/checkout')->with('error', 'Keranjang belanja kosong!');
        }

        $total_price = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $final_total = $total_price + $shipping_cost;

        $orderModel->insert([
            'user_id'         => $user_id,
            'total_price'     => $final_total,
            'shipping_address' => $shipping_address,
            'shipping_cost'   => $shipping_cost,
            'bank_account_id' => $bank_account_id,
            'payment_status'  => 'pending',
        ]);
        
        $order_id = $orderModel->insertID();
        foreach ($cart as $product_id => $item) {
            $orderItemModel->insert([
                'order_id'   => $order_id,
                'product_id' => $product_id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }
        
        session()->remove('cart');
        return redirect()->to("/checkout/invoice/$order_id");
    }

    public function invoice($order_id)
    {
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $bankModel = new BankAccountModel();

        $order = $orderModel->find($order_id);
        if (!$order) {
            return redirect()->to('/')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'       => 'Invoice',
            'order'       => $order,
            'order_items' => $orderItemModel->where('order_id', $order_id)->findAll(),
            'bank'        => $bankModel->find($order['bank_account_id']),
            'isi'         => 'checkout/invoice'
        ];

        return view('layout/v_wrapper', $data);
    }

    public function downloadInvoice($order_id)
    {
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $bankModel = new BankAccountModel();

        $order = $orderModel->find($order_id);
        if (!$order) {
            return redirect()->to('/')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'order'       => $order,
            'order_items' => $orderItemModel->where('order_id', $order_id)->findAll(),
            'bank'        => $bankModel->find($order['bank_account_id']),
            // 'isi'         => 'checkout/invoice_pdf'
        ];

        $html = view('checkout/invoice_pdf', $data);
        

        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('invoice_' . $order_id . '.pdf', ["Attachment" => true]);
    }

    public function uploadPayment()
    {
        $paymentModel = new PaymentModel();
        $order_id = $this->request->getPost('order_id');
        $proof_of_payment = $this->request->getFile('proof_of_payment');

        if ($proof_of_payment->isValid() && !$proof_of_payment->hasMoved()) {
            $newName = $proof_of_payment->getRandomName();
            $proof_of_payment->move('uploads/payments', $newName);

            $paymentModel->insert([
                'order_id' => $order_id,
                'proof_of_payment' => $newName,
                'status' => 'pending',
            ]);

            return redirect()->to('/checkout')->with('success', 'Bukti pembayaran berhasil diunggah!');
        }

        return redirect()->to('/checkout')->with('error', 'Gagal mengunggah bukti pembayaran.');
    }
}
