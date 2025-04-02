<div class="container mt-5">
    <form id="checkout-form" action="<?= base_url('/checkout/process') ?>" method="post">
        <?= csrf_field(); ?>

        <!-- ID Produk (Hidden) -->
        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

        <!-- Total Harga (Hidden) -->
        <input type="hidden" id="total_price_input" name="total_price">

        <!-- Username Pembeli (Readonly) -->
        <div class="mb-3">
            <label>Nama Pembeli:</label>
            <input type="text" class="form-control" value="<?= $user['username']; ?>" readonly>
        </div>

        <!-- Nama Produk (Readonly) -->
        <div class="mb-3">
            <label>Nama Produk:</label>
            <input type="text" class="form-control" value="<?= $product['name']; ?>" readonly>
        </div>

        <!-- Alamat Pengiriman -->
        <div class="mb-3">
            <label>Alamat Pengiriman:</label>
            <textarea name="shipping_address" class="form-control" required></textarea>
        </div>

        <!-- Ongkos Kirim -->
        <div class="mb-3">
            <label>Ongkos Kirim:</label>
            <select id="shipping_id" name="shipping_id" class="form-control" required>
                <option value="" selected disabled>Pilih Ongkir</option>
                <?php foreach ($shipping_rates as $rate) : ?>
                    <option value="<?= $rate['id'] ?>" data-cost="<?= $rate['cost'] ?>">
                        <?= $rate['destination'] ?> - Rp <?= number_format($rate['cost'], 0, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-3">
            <label>Metode Pembayaran:</label>
            <select name="bank_account_id" class="form-control" required>
                <option value="" selected disabled>Pilih Bank</option>
                <?php foreach ($bank_accounts as $bank) : ?>
                    <option value="<?= $bank['id'] ?>">
                        <?= $bank['bank_name'] ?> - <?= $bank['account_number'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Total Harga -->
        <h4 class="mt-3">Total Harga: Rp <span id="total-price">0</span></h4>

        <!-- Tombol Checkout -->
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
</div>

<!-- Script Cek Total Harga (Otomatis) -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let shippingDropdown = document.getElementById("shipping_id");
    let totalPriceSpan = document.getElementById("total-price");
    let totalPriceInput = document.getElementById("total_price_input");
    
    // Ambil harga produk dari PHP
    let productPrice = <?= $product['price']; ?>;

    function updateTotalPrice() {
        let shippingCost = 0;
        
        if (shippingDropdown.value) {
            shippingCost = parseFloat(shippingDropdown.options[shippingDropdown.selectedIndex].getAttribute("data-cost")) || 0;
        }

        let total = productPrice + shippingCost;
        totalPriceSpan.innerText = total.toLocaleString('id-ID');
        totalPriceInput.value = total;
    }

    updateTotalPrice();
    shippingDropdown.addEventListener("change", updateTotalPrice);
});
</script>
