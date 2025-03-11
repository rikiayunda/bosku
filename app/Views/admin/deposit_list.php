<body>
    <div class="container mt-4">
        <h2>Daftar Deposit User</h2>

        <form id="depositForm" method="post" action="<?= site_url('admin/deposit/mass_action') ?>">
            <?= csrf_field(); ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Bank</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($deposits as $deposit): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="deposit_ids[]" value="<?= esc($deposit['id']); ?>">
                        </td>
                        <td><?= $no++; ?></td>
                        <td><?= esc($deposit['full_name']); ?></td>
                        <td><?= esc($deposit['bank']); ?></td>
                        <td>Rp <?= number_format($deposit['nominal'], 0, ',', '.'); ?></td>
                        <td>
                            <span class="badge 
                                <?= ($deposit['status'] == 'pending') ? 'bg-warning' : 
                                   (($deposit['status'] == 'rejected') ? 'bg-danger' : 'bg-success'); ?>">
                                <?= esc(ucwords($deposit['status'])); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($deposit['status'] == 'pending'): ?>
                                <a href="<?= site_url('admin/deposit/update/' . $deposit['id']) ?>" 
                                   class="btn btn-success btn-sm">Setujui</a>
                                <a href="<?= site_url('admin/deposit/reject/' . $deposit['id']) ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menolak deposit ini?');">
                                   Tolak
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Sukses</span>
                            <?php endif; ?>
                            <a href="<?= site_url('admin/deposit/delete/' . $deposit['id']) ?>" 
                               class="btn btn-warning btn-sm" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                               Hapus Riwayat
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <button type="submit" name="action" value="approve" class="btn btn-primary">Setujui Deposit</button>
                <button type="submit" name="action" value="delete" class="btn btn-danger">Hapus Riwayat</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('input[name="deposit_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.getElementById('depositForm').addEventListener('submit', function(e) {
            let checkboxes = document.querySelectorAll('input[name="deposit_ids[]"]:checked');
            if (checkboxes.length === 0) {
                alert("Pilih setidaknya satu transaksi untuk diproses.");
                e.preventDefault();
                return;
            }
        });
    </script>
</body>
