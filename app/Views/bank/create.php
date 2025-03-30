
<form action="<?= base_url('admin/bank/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label>Nama Bank</label>
        <input type="text" name="bank_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nomor Rekening</label>
        <input type="text" name="account_number" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nama Pemilik Rekening</label>
        <input type="text" name="account_holder" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>