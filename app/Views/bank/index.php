
<a href="<?= base_url('admin/bank/create') ?>" class="btn btn-primary">Tambah Rekening</a>

<table class="table">
    <thead>
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
            <td><?= esc($bank['account_number']) ?></td>
            <td><?= esc($bank['account_holder']) ?></td>
            <td>
                <a href="<?= base_url('/bank/delete/' . $bank['id']) ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
