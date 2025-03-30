<head>
    <style>
        .product-card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 1rem;
            background: #fff;
        }

        .image-container {
            width: 100%;
            height: 200px;
            /* Sesuaikan tinggi gambar */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 5px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Memastikan gambar tetap proporsional */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Produk Terbaru</h2>
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="image-container">
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= esc($product['name']) ?>">
                        </div>
                        <h5><?= esc($product['name']) ?></h5>
                        <p>Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                        <a href="<?= base_url('checkout/' . $product['id']) ?>" class="btn btn-primary">Beli</a>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>