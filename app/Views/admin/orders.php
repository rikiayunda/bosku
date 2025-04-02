<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Daftar Pesanan</h2>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/bulk-action'); ?>">
            <?= csrf_field(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Nomor</th>
                            <th>User ID</th>
                            <th>Nama Akun</th>
                            <th>Produk ID</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($orders as $order) : ?>
                            <tr>
                                <td><input type="checkbox" name="order_ids[]" value="<?= $order['id']; ?>"></td>
                                <td><?= $no++; ?></td>
                                <td><?= $order['user_id']; ?></td>
                                <td><?= esc($order['username']); ?></td>
                                <td><?= $order['product_id']; ?></td>
                                <td>Rp <?= number_format($order['total_price'], 0, ',', '.'); ?></td>
                                <td><span class="badge bg-<?= $order['status'] === 'pending' ? 'warning' : 'success'; ?>">
                                    <?= ucfirst($order['status']); ?></span></td>
                                <td>
                                    <?php if ($order['status'] === 'pending') : ?>
                                        <a href="<?= base_url('admin/approve-order/' . $order['id']); ?>" class="btn btn-success btn-sm">
                                            Setujui
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Disetujui</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="text-center mt-3">
                <button type="submit" name="action" value="approve_all" class="btn btn-success me-2" onclick="return confirm('Setujui semua pesanan yang dipilih?');">
                    Setujui Semua
                </button>
                <button type="submit" name="action" value="delete_all" class="btn btn-danger" onclick="return confirm('Hapus semua pesanan yang dipilih?');">
                    Hapus Semua
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="order_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
</body>
