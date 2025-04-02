
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <title>Kelola Pencairan Saldo</title> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<div class="container mt-4">
    <!-- <h2 class="mb-4">Kelola Pencairan Saldo</h2> -->

    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pemegang Rekening</th>
                <th>Nomor Rekening</th>
                <th>Bank</th>
                <th>Jumlah Pencairan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($withdrawals as $index => $withdrawal) : ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= esc($withdrawal['account_holder']); ?></td>
                    <td><?= esc($withdrawal['account_number']); ?></td>
                    <td><?= esc($withdrawal['bank_name']); ?></td>
                    <td>Rp <?= number_format($withdrawal['amount'], 0, ',', '.'); ?></td>
                    <td>
                        <span class="badge <?= ($withdrawal['status'] === 'pending') ? 'bg-warning' : 'bg-success' ?>">
                            <?= ($withdrawal['status'] === 'pending') ? 'Pending' : 'Sukses' ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($withdrawal['status'] === 'pending') : ?>
                            <a href="<?= site_url('admin/withdrawals/approve/' . $withdrawal['id']) ?>" class="btn btn-success btn-sm">
                                Setujui
                            </a>
                        <?php endif; ?>

                        <a href="<?= site_url('admin/withdrawals/delete/' . $withdrawal['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pencairan ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
