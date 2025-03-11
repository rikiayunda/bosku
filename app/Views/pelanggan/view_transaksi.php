<body>
    <div class="container">
        <h2>Riwayat Transaksi</h2>

        <?php if (!empty($transactions)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Detail</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($transactions as $trx): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d M Y, H:i', strtotime($trx['created_at'])) ?></td>
                            <td><?= ucfirst(esc($trx['type'])) ?></td>
                            <td><?= number_format(esc($trx['amount']), 0, ',', '.') ?> IDR</td>
                            <td><?= esc($trx['details']) ?></td>
                            <td>
                                <span class="badge badge-<?= ($trx['status'] == 'completed' ? 'success' : ($trx['status'] == 'pending' ? 'warning' : 'danger')) ?>">
                                    <?= ucfirst(esc($trx['status'])) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Belum ada transaksi.</div>
        <?php endif; ?>

        <a href="<?= base_url('dashboard'); ?>" class="btn btn-primary">Kembali</a>
    </div>
</body>
