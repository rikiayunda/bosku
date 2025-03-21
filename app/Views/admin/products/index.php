<a href="<?= site_url('/admin/products/create') ?>" class="btn btn-success">Tambah Produk</a>

<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Deskripsi</th> <!-- Tambahan kolom Deskripsi -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= esc($product['name']) ?></td>
                <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                <td><img src="<?= base_url('uploads/' . esc($product['image'])) ?>" width="50"></td>
                <td>
                    <?= esc(substr($product['description'], 0, 100)) ?><?= (strlen($product['description']) > 100) ? '...' : '' ?>
                </td> <!-- Menampilkan deskripsi singkat -->
                <td>
                    <a href="<?= base_url('/admin/products/edit/' . $product['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/admin/products/delete/' . $product['id']) ?>" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
