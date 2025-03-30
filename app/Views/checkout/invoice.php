<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $order['id']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-details,
        .bank-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <a href="<?= base_url('checkout/invoice/download/' . $order['id']) ?>" class="btn btn-primary">
        Download Invoice
    </a>



    <div class="header">
        <h2>INVOICE</h2>
        <p>#<?= $order['id']; ?> | <?= date('d M Y', strtotime($order['created_at'])); ?></p>
    </div>

    <div class="invoice-details">
        <p><strong>Alamat Pengiriman:</strong> <?= $order['shipping_address']; ?></p>
        <p><strong>Status Pembayaran:</strong> <?= ucfirst($order['payment_status']); ?></p>
    </div>

    <h3>Detail Pesanan</h3>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $subtotal = 0; ?>
            <?php foreach ($order_items as $item) : ?>
                <tr>
                    <td><?= $item['product_id']; ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                    <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td>
                </tr>
                <?php $subtotal += ($item['price'] * $item['quantity']); ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Ongkos Kirim</strong></td>
                <td>Rp <?= number_format($order['shipping_cost'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Total Bayar</strong></td>
                <td class="total">Rp <?= number_format($order['total_price'], 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="bank-info">
        <h3>Metode Pembayaran</h3>
        <p><strong>Bank:</strong> <?= $bank['bank_name']; ?></p>
        <p><strong>Nomor Rekening:</strong> <?= $bank['account_number']; ?></p>
        <p><strong>Silakan transfer ke rekening di atas dan unggah bukti pembayaran.</strong></p>
    </div>

    <p style="text-align: center; margin-top: 20px;">Terima kasih telah berbelanja di toko kami!</p>

</body>