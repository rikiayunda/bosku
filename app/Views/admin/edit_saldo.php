<p><strong>Nama:</strong> <?= esc($user['full_name']); ?></p>
<p><strong>Saldo Saat Ini:</strong> Rp<?= number_format($user['saldo'], 0, ',', '.'); ?></p>

<form action="<?= base_url('admin/update-saldo'); ?>" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="user_id" value="<?= esc($user['id']); ?>">

    <label for="amount">Jumlah Saldo:</label>
    <input type="number" name="amount" id="amount" min="1" required>

    <button type="submit" name="action" value="tambah">Tambah</button>
    <button type="submit" name="action" value="kurangi">Kurangi</button>
</form>

<!-- Tombol Reset Saldo -->
<form action="<?= base_url('admin/reset-saldo'); ?>" method="post" style="margin-top: 10px;">
    <?= csrf_field(); ?>
    <input type="hidden" name="user_id" value="<?= esc($user['id']); ?>">
    <button type="submit" style="background-color: red; color: white;">Reset Saldo</button>
</form>
