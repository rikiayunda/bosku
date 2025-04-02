<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-primary">Daftar Rekening Bank</h3>
            <a href="<?= base_url('admin/bank/create') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Rekening
            </a>
        </div>

        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Bank</th>
                        <th>Nomor Rekening</th>
                        <th>Pemilik Rekening</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banks as $index => $bank): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($bank['bank_name']) ?></td>
                            <td style="word-break: break-all;"><?= esc($bank['account_number']) ?></td>
                            <td><?= esc($bank['account_holder']) ?></td>
                            <td>
                                <a href="#" onclick="confirmDelete('<?= base_url('admin/bank/delete/' . $bank['id']) ?>')" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url) {
        if (confirm("Apakah Anda yakin ingin menghapus rekening ini?")) {
            window.location.href = url;
        }
    }
</script>
