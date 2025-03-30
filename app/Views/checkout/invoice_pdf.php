<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $order['id'] ?></title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }
        .invoice-box { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .invoice-box th, .invoice-box td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .invoice-box th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Invoice #<?= $order['id'] ?></h2>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($order['created_at'])) ?></p>
    <p><strong>Alamat Pengiriman:</strong> <?= $order['shipping_address'] ?></p>

    <table class="invoice-box">
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($order_items as $item): ?>
        <tr>
            <td><?= $item['product_id'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Ongkos Kirim</strong></td>
            <td>Rp <?= number_format($order['shipping_cost'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>Rp <?= number_format($order['total_price'], 0, ',', '.') ?></strong></td>
        </tr>
    </table>

    <p><strong>Metode Pembayaran:</strong> <?= $bank['bank_name'] ?> - <?= $bank['account_number'] ?></p>
</body>
</html>
