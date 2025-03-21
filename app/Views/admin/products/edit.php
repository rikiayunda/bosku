<form action="<?= base_url('admin/products/update/'. $product['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" name="name" class="form-control" value="<?= esc($product['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" name="price" class="form-control" value="<?= esc($product['price']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" required><?= esc($product['description']) ?></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Upload Gambar</label>
        <input type="file" name="image" class="form-control" accept=".jpg, .jpeg">
        <small class="text-muted">Hanya diperbolehkan format JPG atau JPEG.</small>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Kembali</a>
</form>
